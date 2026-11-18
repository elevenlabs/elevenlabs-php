<?php

declare(strict_types=1);

namespace ElevenLabs\Flows\Wait;

use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Exceptions\ElevenlabsException;
use ElevenLabs\Exceptions\ValidationException;
use ElevenLabs\Services\BaseService;
use Psr\Http\Message\ResponseInterface;

/**
 * The polling loop shared by every `createAndWait`.
 *
 * Hand-written (see `.fernignore`), mirroring `flows_custom.py` in the Python SDK.
 *
 * @internal
 */
final class Poller
{
  /**
   * Matches the server's shortest `Retry-After` (3s for image, audio and text), so the SDK polls
   * no faster than the server would pace it when the header is missing.
   */
  public const DEFAULT_MIN_POLL_INTERVAL_SECONDS = 3.0;

  /** Below this, a missing server hint would turn the wait into a tight loop of status checks. */
  public const SMALLEST_MIN_POLL_INTERVAL_SECONDS = 0.5;

  /** Spreads out clients that started together so their status checks don't arrive in lockstep. */
  private const POLL_JITTER = 0.2;

  private const TERMINAL_STATUSES = ['completed', 'failed'];

  public function __construct(private readonly PollClock $clock)
  {
  }

  public function clock(): PollClock
  {
    return $this->clock;
  }

  /**
   * @throws ValidationException
   */
  public static function checkWaitOptions(?float $waitTimeoutInSeconds, float $minPollIntervalInSeconds): void
  {
    // NaN passes every `<` check, and an infinite interval would never poll, so both are rejected explicitly.
    if (!is_finite($minPollIntervalInSeconds) || $minPollIntervalInSeconds < self::SMALLEST_MIN_POLL_INTERVAL_SECONDS) {
      throw new ValidationException(
        'minPollIntervalInSeconds',
        'must be a finite number of at least ' . self::SMALLEST_MIN_POLL_INTERVAL_SECONDS . "s, got " . self::describe($minPollIntervalInSeconds)
      );
    }
    // Written as `!(>= 0)` so NaN fails too: a NaN deadline never compares as passed, so the wait would
    // silently ignore the timeout. 0 times out straight after the create; null or INF waits indefinitely.
    if ($waitTimeoutInSeconds !== null && !($waitTimeoutInSeconds >= 0)) {
      throw new ValidationException('waitTimeoutInSeconds', "must be at least 0s, got " . self::describe($waitTimeoutInSeconds));
    }
  }

  /** NaN and INF spelled out: PHP 8.5 warns when a NaN is interpolated into a string. */
  private static function describe(float $value): string
  {
    if (is_nan($value)) {
      return 'NAN';
    }
    return is_infinite($value) ? ($value > 0 ? 'INF' : '-INF') : var_export($value, true);
  }

  /**
   * The caller's options for the status GETs: everything except `bodyProperties`, which only the
   * create takes.
   *
   * @param ?array<string, mixed> $options
   * @return ?array<string, mixed>
   */
  public static function pollOptions(?array $options): ?array
  {
    if ($options === null || !array_key_exists('bodyProperties', $options)) {
      return $options;
    }
    unset($options['bodyProperties']);
    return $options;
  }

  /**
   * Seconds from a `Retry-After` header, given as whole seconds or an HTTP date (RFC 9110), or
   * null if absent or unparseable. Kept here rather than borrowed from the generated retry code,
   * whose private helpers can change on any regeneration.
   */
  public static function parseRetryAfter(ResponseInterface $response, float $now): ?float
  {
    // The first value, not `getHeaderLine`: an HTTP date contains a comma, so joined values can't be split again.
    $values = $response->getHeader('Retry-After');
    if ($values === []) {
      return null;
    }
    $value = trim($values[0]);
    if ($value !== '' && ctype_digit($value)) {
      return (float) $value;
    }
    // IMF-fixdate, then the obsolete RFC 850 and asctime forms RFC 9110 asks recipients to accept.
    foreach (['D, d M Y H:i:s \G\M\T', 'l, d-M-y H:i:s \G\M\T', 'D M j H:i:s Y'] as $format) {
      $date = \DateTimeImmutable::createFromFormat('!' . $format, $value, new \DateTimeZone('UTC'));
      $errors = \DateTimeImmutable::getLastErrors();
      if ($date !== false && ($errors === false || ($errors['warning_count'] === 0 && $errors['error_count'] === 0))) {
        return max((float) $date->format('U.u') - $now, 0.0);
      }
    }
    return null;
  }

  /**
   * Seconds to wait before the next GET: the server's `Retry-After`, never below
   * `$minInterval`, plus 0-20% jitter.
   */
  public function pollDelay(ResponseInterface $response, float $minInterval): float
  {
    $retryAfter = self::parseRetryAfter($response, $this->clock->now());
    $delay = max($retryAfter ?? $minInterval, $minInterval);
    return $delay * (1 + $this->clock->random() * self::POLL_JITTER);
  }

  public static function statusOf(object $response): string
  {
    /** @var mixed $status */
    $status = $response->status ?? null;
    if ($status instanceof \BackedEnum) {
      return (string) $status->value;
    }
    return is_string($status) ? $status : 'unknown';
  }

  /**
   * Polls with `$get` until the response is `completed` or `failed`, and returns it.
   *
   * @param \Closure(): array{object, ResponseInterface} $get Fetches the latest state and its HTTP response.
   * @throws FlowsWaitTimeoutError
   */
  public function wait(
    string $id,
    object $firstResponse,
    ResponseInterface $firstHttpResponse,
    \Closure $get,
    float $startedAt,
    ?float $waitTimeoutInSeconds,
    float $minInterval,
    ?string $templateId = null,
  ): object {
    $response = $firstResponse;
    $httpResponse = $firstHttpResponse;
    while (!in_array(self::statusOf($response), self::TERMINAL_STATUSES, true)) {
      $delay = $this->pollDelay($httpResponse, $minInterval);
      if ($waitTimeoutInSeconds !== null) {
        // The last sleep ends on the deadline; the GET after it takes time, so the next pass throws.
        $remaining = $startedAt + $waitTimeoutInSeconds - $this->clock->monotonic();
        if ($remaining <= 0) {
          throw new FlowsWaitTimeoutError($id, $waitTimeoutInSeconds, $response, $templateId);
        }
        $delay = min($delay, $remaining);
      }
      $this->clock->sleep($delay);
      [$response, $httpResponse] = $get();
    }
    return $response;
  }

  /**
   * Sends a JSON request through a generated service exactly as its own methods do (same resolved
   * configuration, base URL, retries and error handling), but returns the HTTP response so the
   * `Retry-After` header can be read. The generated methods return only the deserialized body.
   *
   * @param string $methodConfig The service's method-level config property the generated method reads, such as `getConfig`.
   * @param ?array<string, mixed> $options
   */
  public static function send(
    BaseService $service,
    string $methodConfig,
    HttpMethod $method,
    string $path,
    mixed $body,
    ?array $options,
  ): ResponseInterface {
    $send = \Closure::bind(
      function () use ($methodConfig, $method, $path, $body, $options): ResponseInterface {
        /** @var BaseService $this */
        $resolvedConfig = $this->getResolvedConfig($this->{$methodConfig}, $options);
        return $this->sendJsonRequest(
          new JsonApiRequest(
            baseUrl: $this->getBaseUrl($resolvedConfig),
            path: $path,
            method: $method,
            body: $body
          ),
          $resolvedConfig
        );
      },
      $service,
      $service::class
    );
    return $send();
  }

  /**
   * Runs a generated type's deserializer, with the generated methods' error translation.
   *
   * @template T
   * @param \Closure(string): T $deserialize
   * @return T
   * @throws ElevenlabsException
   */
  public static function deserialize(ResponseInterface $response, \Closure $deserialize): mixed
  {
    $data = $response->getBody()->getContents();
    try {
      return $deserialize($data);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
  }

  /**
   * The generated `BaseService::decodeJson`, so a generation decodes exactly as the generated `get` decodes it.
   *
   * @return array<mixed>
   */
  public static function decodeJson(BaseService $service, string $json): array
  {
    $decode = \Closure::bind(
      function () use ($json): mixed {
        /** @var BaseService $this */
        return $this->decodeJson($json);
      },
      $service,
      $service::class
    );
    $decoded = $decode();
    return is_array($decoded) ? $decoded : [];
  }
}

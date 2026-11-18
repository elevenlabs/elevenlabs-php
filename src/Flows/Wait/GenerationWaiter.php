<?php

declare(strict_types=1);

namespace ElevenLabs\Flows\Wait;

use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Core\Client\RawClient;
use ElevenLabs\Services\BaseService;
use ElevenLabs\Types\MediaGenerationCreateResponse;
use ElevenLabs\Types\MediaGenerationResponse;
use ElevenLabs\Utils\Serializer;
use Psr\Http\Message\ResponseInterface;

/**
 * The shared `createAndWait` of the image, video and text-to-speech waiters.
 *
 * Hand-written (see `.fernignore`).
 *
 * @internal Use `ImageWaiter`, `VideoWaiter` or `TextToSpeechWaiter`.
 */
abstract class GenerationWaiter
{
  public function __construct(
    private readonly BaseService $service,
    private readonly string $path,
    private readonly Poller $poller,
  ) {
  }

  /**
   * @param ?array<string, mixed> $options
   * @throws FlowsWaitTimeoutError
   * @throws \ElevenLabs\Exceptions\ValidationException
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  protected function run(
    \JsonSerializable $request,
    ?float $waitTimeoutInSeconds,
    float $minPollIntervalInSeconds,
    ?array $options,
  ): MediaGenerationResponse {
    Poller::checkWaitOptions($waitTimeoutInSeconds, $minPollIntervalInSeconds);
    $startedAt = $this->poller->clock()->monotonic();

    $createdHttp = Poller::send($this->service, 'createConfig', HttpMethod::POST, $this->path, $request, $options);
    $created = Poller::deserialize(
      $createdHttp,
      static fn(string $data): MediaGenerationCreateResponse => Serializer::deserialize($data, MediaGenerationCreateResponse::class)
    );
    $generationId = $created->id;
    $pollOptions = Poller::pollOptions($options);
    $get = fn(): array => $this->get($generationId, $pollOptions);

    $result = $this->poller->wait(
      id: $generationId,
      firstResponse: $created,
      firstHttpResponse: $createdHttp,
      get: $get,
      startedAt: $startedAt,
      waitTimeoutInSeconds: $waitTimeoutInSeconds,
      minInterval: $minPollIntervalInSeconds,
    );
    if ($result instanceof MediaGenerationResponse) {
      return $result;
    }
    // A create response that is already terminal carries no output; fetch the full generation.
    return $get()[0];
  }

  /**
   * @param ?array<string, mixed> $options
   * @return array{MediaGenerationResponse, ResponseInterface}
   */
  private function get(string $generationId, ?array $options): array
  {
    $http = Poller::send(
      $this->service,
      'getConfig',
      HttpMethod::GET,
      $this->path . '/' . RawClient::encodePathParam($generationId),
      null,
      $options
    );
    $service = $this->service;
    $response = Poller::deserialize(
      $http,
      static fn(string $data): MediaGenerationResponse => MediaGenerationResponse::fromArray(Poller::decodeJson($service, $data))
    );
    return [$response, $http];
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class RetryPolicy extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * How long to wait before a short retry.
   */
  #[JsonProperty('retry_delay_seconds')]
  public ?int $retryDelaySeconds;

  /**
   * Retries a calling window allows after a failed call. Once used up, the next retry waits for the following window, which starts afresh.
   */
  #[JsonProperty('max_short_retries')]
  public ?int $maxShortRetries;

  /**
   * The most calls a lead gets, counting the first.
   */
  #[JsonProperty('max_total_calls')]
  public ?int $maxTotalCalls;

  /**
   * The most callbacks to honor for one number.
   */
  #[JsonProperty('max_callbacks')]
  public ?int $maxCallbacks;

  /**
   * The most times a lead follows a request to call another number.
   */
  #[JsonProperty('max_redirects')]
  public ?int $maxRedirects;

  /**
   * @var ?value-of<\ElevenLabs\Types\IntervalPlacement>
   */
  #[JsonProperty('interval_placement')]
  public ?string $intervalPlacement;

  /**
   * How far `rotate` placement moves each call. Only used by `rotate`.
   */
  #[JsonProperty('rotate_step_seconds')]
  public ?int $rotateStepSeconds;

  /**
   * Calls to one number that may fail in a row before the lead moves on to its next listed number, or ends when there is none. An answered call, or a redirect to a new number, restarts the count. Unset leaves only `max_total_calls`.
   */
  #[JsonProperty('max_consecutive_failures_per_number')]
  public ?int $maxConsecutiveFailuresPerNumber;

  /**
   * @param array{
   *   retryDelaySeconds?: ?int,
   *   maxShortRetries?: ?int,
   *   maxTotalCalls?: ?int,
   *   maxCallbacks?: ?int,
   *   maxRedirects?: ?int,
   *   intervalPlacement?: ?value-of<\ElevenLabs\Types\IntervalPlacement>,
   *   rotateStepSeconds?: ?int,
   *   maxConsecutiveFailuresPerNumber?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->retryDelaySeconds = $values['retryDelaySeconds'] ?? null;
    $this->maxShortRetries = $values['maxShortRetries'] ?? null;
    $this->maxTotalCalls = $values['maxTotalCalls'] ?? null;
    $this->maxCallbacks = $values['maxCallbacks'] ?? null;
    $this->maxRedirects = $values['maxRedirects'] ?? null;
    $this->intervalPlacement = $values['intervalPlacement'] ?? null;
    $this->rotateStepSeconds = $values['rotateStepSeconds'] ?? null;
    $this->maxConsecutiveFailuresPerNumber = $values['maxConsecutiveFailuresPerNumber'] ?? null;

    if (array_key_exists('retryDelaySeconds', $values)) {
      $this->_dirtyFields['retry_delay_seconds'] = true;
    }
    if (array_key_exists('maxShortRetries', $values)) {
      $this->_dirtyFields['max_short_retries'] = true;
    }
    if (array_key_exists('maxTotalCalls', $values)) {
      $this->_dirtyFields['max_total_calls'] = true;
    }
    if (array_key_exists('maxCallbacks', $values)) {
      $this->_dirtyFields['max_callbacks'] = true;
    }
    if (array_key_exists('maxRedirects', $values)) {
      $this->_dirtyFields['max_redirects'] = true;
    }
    if (array_key_exists('intervalPlacement', $values)) {
      $this->_dirtyFields['interval_placement'] = true;
    }
    if (array_key_exists('rotateStepSeconds', $values)) {
      $this->_dirtyFields['rotate_step_seconds'] = true;
    }
    if (array_key_exists('maxConsecutiveFailuresPerNumber', $values)) {
      $this->_dirtyFields['max_consecutive_failures_per_number'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->retryDelaySeconds !== null) {
      $parts[] = [
        'name' => 'retry_delay_seconds',
        'contents' => (string) $this->retryDelaySeconds
      ];
    }

    if ($this->maxShortRetries !== null) {
      $parts[] = [
        'name' => 'max_short_retries',
        'contents' => (string) $this->maxShortRetries
      ];
    }

    if ($this->maxTotalCalls !== null) {
      $parts[] = [
        'name' => 'max_total_calls',
        'contents' => (string) $this->maxTotalCalls
      ];
    }

    if ($this->maxCallbacks !== null) {
      $parts[] = [
        'name' => 'max_callbacks',
        'contents' => (string) $this->maxCallbacks
      ];
    }

    if ($this->maxRedirects !== null) {
      $parts[] = [
        'name' => 'max_redirects',
        'contents' => (string) $this->maxRedirects
      ];
    }

    if ($this->intervalPlacement !== null) {
      $parts[] = [
        'name' => 'interval_placement',
        'contents' => $this->intervalPlacement
      ];
    }

    if ($this->rotateStepSeconds !== null) {
      $parts[] = [
        'name' => 'rotate_step_seconds',
        'contents' => (string) $this->rotateStepSeconds
      ];
    }

    if ($this->maxConsecutiveFailuresPerNumber !== null) {
      $parts[] = [
        'name' => 'max_consecutive_failures_per_number',
        'contents' => (string) $this->maxConsecutiveFailuresPerNumber
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->maxShortRetries, 'max_short_retries', min: 0, max: 30);
    Validator::validateNumber($this->maxTotalCalls, 'max_total_calls', min: 1, max: 30);
    Validator::validateNumber($this->maxCallbacks, 'max_callbacks', min: 0, max: 30);
    Validator::validateNumber($this->maxRedirects, 'max_redirects', min: 0, max: 30);
    Validator::validateNumber(
      $this->maxConsecutiveFailuresPerNumber,
      'max_consecutive_failures_per_number',
      min: 1,
      max: 30
    );
  }
}

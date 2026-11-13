<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class FineTuningResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether the user is allowed to fine-tune the voice.
   */
  #[JsonProperty('is_allowed_to_fine_tune')]
  public ?bool $isAllowedToFineTune;

  /**
   * @var array<string, value-of<\ElevenLabs\Types\FineTuningResponseStateValue>>|null
   * The state of the fine-tuning process for each model.
   */
  #[JsonProperty('state'), ArrayType(['string' => 'string'])]
  public ?array $state;

  /**
   * @var string[]|null
   * List of verification failures in the fine-tuning process.
   */
  #[JsonProperty('verification_failures'), ArrayType(['string'])]
  public ?array $verificationFailures;

  /**
   * The number of verification attempts in the fine-tuning process.
   */
  #[JsonProperty('verification_attempts_count')]
  public ?int $verificationAttemptsCount;

  /**
   * Whether a manual verification was requested for the fine-tuning process.
   */
  #[JsonProperty('manual_verification_requested')]
  public ?bool $manualVerificationRequested;

  /**
   * The language of the fine-tuning process.
   */
  #[JsonProperty('language')]
  public ?string $language;

  /**
   * @var array<string, float>|null
   * The progress of the fine-tuning process.
   */
  #[JsonProperty('progress'), ArrayType(['string' => 'float'])]
  public ?array $progress;

  /**
   * @var array<string, string>|null
   * The message of the fine-tuning process.
   */
  #[JsonProperty('message'), ArrayType(['string' => 'string'])]
  public ?array $message;

  /**
   * The duration of the dataset in seconds.
   */
  #[JsonProperty('dataset_duration_seconds')]
  public ?float $datasetDurationSeconds;

  /**
   * @var \ElevenLabs\Types\VerificationAttemptResponse[]|null
   * The number of verification attempts.
   */
  #[
    JsonProperty('verification_attempts'),
    ArrayType([\ElevenLabs\Types\VerificationAttemptResponse::class])
  ]
  public ?array $verificationAttempts;

  /**
   * @var string[]|null
   * List of slice IDs.
   */
  #[JsonProperty('slice_ids'), ArrayType(['string'])]
  public ?array $sliceIds;

  /**
   * The manual verification of the fine-tuning process.
   */
  #[JsonProperty('manual_verification')]
  public ?\ElevenLabs\Types\ManualVerificationResponse $manualVerification;

  /**
   * The maximum number of verification attempts.
   */
  #[JsonProperty('max_verification_attempts')]
  public ?int $maxVerificationAttempts;

  /**
   * The next maximum verification attempts reset time in Unix milliseconds.
   */
  #[JsonProperty('next_max_verification_attempts_reset_unix_ms')]
  public ?int $nextMaxVerificationAttemptsResetUnixMs;

  #[JsonProperty('finetuning_state')]
  public mixed $finetuningState;

  /**
   * @param array{
   *   isAllowedToFineTune?: ?bool,
   *   state?: array<string, value-of<\ElevenLabs\Types\FineTuningResponseStateValue>>|null,
   *   verificationFailures?: string[]|null,
   *   verificationAttemptsCount?: ?int,
   *   manualVerificationRequested?: ?bool,
   *   language?: ?string,
   *   progress?: array<string, float>|null,
   *   message?: array<string, string>|null,
   *   datasetDurationSeconds?: ?float,
   *   verificationAttempts?: \ElevenLabs\Types\VerificationAttemptResponse[]|null,
   *   sliceIds?: string[]|null,
   *   manualVerification?: ?\ElevenLabs\Types\ManualVerificationResponse,
   *   maxVerificationAttempts?: ?int,
   *   nextMaxVerificationAttemptsResetUnixMs?: ?int,
   *   finetuningState?: mixed,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->isAllowedToFineTune = $values['isAllowedToFineTune'] ?? null;
    $this->state = $values['state'] ?? null;
    $this->verificationFailures = $values['verificationFailures'] ?? null;
    $this->verificationAttemptsCount = $values['verificationAttemptsCount'] ?? null;
    $this->manualVerificationRequested = $values['manualVerificationRequested'] ?? null;
    $this->language = $values['language'] ?? null;
    $this->progress = $values['progress'] ?? null;
    $this->message = $values['message'] ?? null;
    $this->datasetDurationSeconds = $values['datasetDurationSeconds'] ?? null;
    $this->verificationAttempts = $values['verificationAttempts'] ?? null;
    $this->sliceIds = $values['sliceIds'] ?? null;
    $this->manualVerification = $values['manualVerification'] ?? null;
    $this->maxVerificationAttempts = $values['maxVerificationAttempts'] ?? null;
    $this->nextMaxVerificationAttemptsResetUnixMs =
      $values['nextMaxVerificationAttemptsResetUnixMs'] ?? null;
    $this->finetuningState = $values['finetuningState'] ?? null;

    if (array_key_exists('isAllowedToFineTune', $values)) {
      $this->_dirtyFields['is_allowed_to_fine_tune'] = true;
    }
    if (array_key_exists('state', $values)) {
      $this->_dirtyFields['state'] = true;
    }
    if (array_key_exists('verificationFailures', $values)) {
      $this->_dirtyFields['verification_failures'] = true;
    }
    if (array_key_exists('verificationAttemptsCount', $values)) {
      $this->_dirtyFields['verification_attempts_count'] = true;
    }
    if (array_key_exists('manualVerificationRequested', $values)) {
      $this->_dirtyFields['manual_verification_requested'] = true;
    }
    if (array_key_exists('language', $values)) {
      $this->_dirtyFields['language'] = true;
    }
    if (array_key_exists('progress', $values)) {
      $this->_dirtyFields['progress'] = true;
    }
    if (array_key_exists('message', $values)) {
      $this->_dirtyFields['message'] = true;
    }
    if (array_key_exists('datasetDurationSeconds', $values)) {
      $this->_dirtyFields['dataset_duration_seconds'] = true;
    }
    if (array_key_exists('verificationAttempts', $values)) {
      $this->_dirtyFields['verification_attempts'] = true;
    }
    if (array_key_exists('sliceIds', $values)) {
      $this->_dirtyFields['slice_ids'] = true;
    }
    if (array_key_exists('manualVerification', $values)) {
      $this->_dirtyFields['manual_verification'] = true;
    }
    if (array_key_exists('maxVerificationAttempts', $values)) {
      $this->_dirtyFields['max_verification_attempts'] = true;
    }
    if (array_key_exists('nextMaxVerificationAttemptsResetUnixMs', $values)) {
      $this->_dirtyFields['next_max_verification_attempts_reset_unix_ms'] = true;
    }
    if (array_key_exists('finetuningState', $values)) {
      $this->_dirtyFields['finetuning_state'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->isAllowedToFineTune !== null) {
      $parts[] = [
        'name' => 'is_allowed_to_fine_tune',
        'contents' => $this->isAllowedToFineTune ? 'true' : 'false'
      ];
    }

    if ($this->state !== null) {
      $parts[] = [
        'name' => 'state',
        'contents' => json_encode($this->state),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->verificationFailures !== null) {
      foreach ($this->verificationFailures ?? [] as $item) {
        $parts[] = [
          'name' => 'verification_failures',
          'contents' => $item
        ];
      }
    }

    if ($this->verificationAttemptsCount !== null) {
      $parts[] = [
        'name' => 'verification_attempts_count',
        'contents' => (string) $this->verificationAttemptsCount
      ];
    }

    if ($this->manualVerificationRequested !== null) {
      $parts[] = [
        'name' => 'manual_verification_requested',
        'contents' => $this->manualVerificationRequested ? 'true' : 'false'
      ];
    }

    if ($this->language !== null) {
      $parts[] = [
        'name' => 'language',
        'contents' => $this->language
      ];
    }

    if ($this->progress !== null) {
      $parts[] = [
        'name' => 'progress',
        'contents' => json_encode($this->progress),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->message !== null) {
      $parts[] = [
        'name' => 'message',
        'contents' => json_encode($this->message),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->datasetDurationSeconds !== null) {
      $parts[] = [
        'name' => 'dataset_duration_seconds',
        'contents' => (string) $this->datasetDurationSeconds
      ];
    }

    if ($this->verificationAttempts !== null) {
      $parts[] = [
        'name' => 'verification_attempts',
        'contents' => json_encode($this->verificationAttempts),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->sliceIds !== null) {
      foreach ($this->sliceIds ?? [] as $item) {
        $parts[] = [
          'name' => 'slice_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->manualVerification !== null) {
      $parts[] = [
        'name' => 'manual_verification',
        'contents' => json_encode($this->manualVerification),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->maxVerificationAttempts !== null) {
      $parts[] = [
        'name' => 'max_verification_attempts',
        'contents' => (string) $this->maxVerificationAttempts
      ];
    }

    if ($this->nextMaxVerificationAttemptsResetUnixMs !== null) {
      $parts[] = [
        'name' => 'next_max_verification_attempts_reset_unix_ms',
        'contents' => (string) $this->nextMaxVerificationAttemptsResetUnixMs
      ];
    }

    if ($this->finetuningState !== null) {
      $parts[] = [
        'name' => 'finetuning_state',
        'contents' => json_encode($this->finetuningState),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->verificationAttempts ?? [] as $item) {
      $item->validate();
    }
    $this->manualVerification?->validate();
  }
}

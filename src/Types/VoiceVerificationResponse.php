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
class VoiceVerificationResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether the voice requires verification.
   */
  #[JsonProperty('requires_verification', required: true)]
  public bool $requiresVerification;

  /**
   * Whether the voice has been verified.
   */
  #[JsonProperty('is_verified', required: true)]
  public bool $isVerified;

  /**
   * @var string[]
   * List of verification failures.
   */
  #[JsonProperty('verification_failures', required: true), ArrayType(['string'])]
  public array $verificationFailures;

  /**
   * The number of verification attempts.
   */
  #[JsonProperty('verification_attempts_count', required: true)]
  public int $verificationAttemptsCount;

  /**
   * The language of the voice.
   */
  #[JsonProperty('language')]
  public ?string $language;

  /**
   * @var \ElevenLabs\Types\VerificationAttemptResponse[]|null
   * Number of times a verification was attempted.
   */
  #[
    JsonProperty('verification_attempts'),
    ArrayType([\ElevenLabs\Types\VerificationAttemptResponse::class])
  ]
  public ?array $verificationAttempts;

  /**
   * @param array{
   *   requiresVerification: bool,
   *   isVerified: bool,
   *   verificationFailures: string[],
   *   verificationAttemptsCount: int,
   *   language?: ?string,
   *   verificationAttempts?: \ElevenLabs\Types\VerificationAttemptResponse[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->requiresVerification = $values['requiresVerification'];
    $this->isVerified = $values['isVerified'];
    $this->verificationFailures = $values['verificationFailures'];
    $this->verificationAttemptsCount = $values['verificationAttemptsCount'];
    $this->language = $values['language'] ?? null;
    $this->verificationAttempts = $values['verificationAttempts'] ?? null;

    $this->_dirtyFields = [
      'requires_verification' => true,
      'is_verified' => true,
      'verification_failures' => true,
      'verification_attempts_count' => true
    ];
    if (array_key_exists('language', $values)) {
      $this->_dirtyFields['language'] = true;
    }
    if (array_key_exists('verificationAttempts', $values)) {
      $this->_dirtyFields['verification_attempts'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'requires_verification',
      'contents' => $this->requiresVerification ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'is_verified',
      'contents' => $this->isVerified ? 'true' : 'false'
    ];

    foreach ($this->verificationFailures as $item) {
      $parts[] = [
        'name' => 'verification_failures',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'verification_attempts_count',
      'contents' => (string) $this->verificationAttemptsCount
    ];

    if ($this->language !== null) {
      $parts[] = [
        'name' => 'language',
        'contents' => $this->language
      ];
    }

    if ($this->verificationAttempts !== null) {
      $parts[] = [
        'name' => 'verification_attempts',
        'contents' => json_encode($this->verificationAttempts),
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
  }
}

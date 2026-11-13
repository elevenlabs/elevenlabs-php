<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CreateClientSecretRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('session')]
  public ?\ElevenLabs\Types\OpenAiSessionConfigInput $session;

  #[JsonProperty('expires_after')]
  public ?\ElevenLabs\Types\ExpiresAfter $expiresAfter;

  /**
   * @param array{
   *   session?: ?\ElevenLabs\Types\OpenAiSessionConfigInput,
   *   expiresAfter?: ?\ElevenLabs\Types\ExpiresAfter,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->session = $values['session'] ?? null;
    $this->expiresAfter = $values['expiresAfter'] ?? null;

    if (array_key_exists('session', $values)) {
      $this->_dirtyFields['session'] = true;
    }
    if (array_key_exists('expiresAfter', $values)) {
      $this->_dirtyFields['expires_after'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->session !== null) {
      $parts[] = [
        'name' => 'session',
        'contents' => json_encode($this->session),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->expiresAfter !== null) {
      $parts[] = [
        'name' => 'expires_after',
        'contents' => json_encode($this->expiresAfter),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->session?->validate();
    $this->expiresAfter?->validate();
  }
}

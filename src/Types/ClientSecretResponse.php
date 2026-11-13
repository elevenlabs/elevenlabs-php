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
class ClientSecretResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('value', required: true)]
  public string $value;

  #[JsonProperty('expires_at', required: true)]
  public int $expiresAt;

  #[JsonProperty('session')]
  public ?\ElevenLabs\Types\OpenAiSessionConfigOutput $session;

  /**
   * @param array{
   *   value: string,
   *   expiresAt: int,
   *   session?: ?\ElevenLabs\Types\OpenAiSessionConfigOutput,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->value = $values['value'];
    $this->expiresAt = $values['expiresAt'];
    $this->session = $values['session'] ?? null;

    $this->_dirtyFields = [
      'value' => true,
      'expires_at' => true
    ];
    if (array_key_exists('session', $values)) {
      $this->_dirtyFields['session'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'value',
      'contents' => $this->value
    ];

    $parts[] = [
      'name' => 'expires_at',
      'contents' => (string) $this->expiresAt
    ];

    if ($this->session !== null) {
      $parts[] = [
        'name' => 'session',
        'contents' => json_encode($this->session),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->session?->validate();
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A custom webhook header value, encrypted at rest.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AlertingWebhookSecretHeaderValue extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('encrypted_value', required: true)]
  public string $encryptedValue;

  #[JsonProperty('nonce', required: true)]
  public string $nonce;

  /**
   * @param array{
   *   encryptedValue: string,
   *   nonce: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->encryptedValue = $values['encryptedValue'];
    $this->nonce = $values['nonce'];

    $this->_dirtyFields = [
      'encrypted_value' => true,
      'nonce' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'encrypted_value',
      'contents' => $this->encryptedValue
    ];

    $parts[] = [
      'name' => 'nonce',
      'contents' => $this->nonce
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

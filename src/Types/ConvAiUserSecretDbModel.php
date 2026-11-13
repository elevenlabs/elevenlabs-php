<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * User-specific secret model that are not shared with other users in a workspace.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ConvAiUserSecretDbModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('encrypted_value', required: true)]
  public string $encryptedValue;

  #[JsonProperty('nonce', required: true)]
  public string $nonce;

  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * @param array{
   *   name: string,
   *   encryptedValue: string,
   *   nonce: string,
   *   id: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->encryptedValue = $values['encryptedValue'];
    $this->nonce = $values['nonce'];
    $this->id = $values['id'];

    $this->_dirtyFields = [
      'name' => true,
      'encrypted_value' => true,
      'nonce' => true,
      'id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'encrypted_value',
      'contents' => $this->encryptedValue
    ];

    $parts[] = [
      'name' => 'nonce',
      'contents' => $this->nonce
    ];

    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

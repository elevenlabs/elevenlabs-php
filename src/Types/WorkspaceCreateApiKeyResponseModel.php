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
class WorkspaceCreateApiKeyResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('xi-api-key', required: true)]
  public string $xiApiKey;

  #[JsonProperty('key_id', required: true)]
  public string $keyId;

  /**
   * @param array{
   *   xiApiKey: string,
   *   keyId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiApiKey = $values['xiApiKey'];
    $this->keyId = $values['keyId'];

    $this->_dirtyFields = [
      'xi-api-key' => true,
      'key_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'xi-api-key',
      'contents' => $this->xiApiKey
    ];

    $parts[] = [
      'name' => 'key_id',
      'contents' => $this->keyId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

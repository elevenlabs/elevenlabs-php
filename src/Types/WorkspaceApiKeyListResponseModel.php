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
class WorkspaceApiKeyListResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\WorkspaceApiKeyResponseModel[]
   */
  #[
    JsonProperty('api-keys', required: true),
    ArrayType([\ElevenLabs\Types\WorkspaceApiKeyResponseModel::class])
  ]
  public array $apiKeys;

  /**
   * @param array{
   *   apiKeys: \ElevenLabs\Types\WorkspaceApiKeyResponseModel[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->apiKeys = $values['apiKeys'];

    $this->_dirtyFields = [
      'api-keys' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'api-keys',
      'contents' => json_encode($this->apiKeys),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->apiKeys as $item) {
      $item->validate();
    }
  }
}

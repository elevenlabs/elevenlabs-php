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
class GetUserVoiceCollectionsResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\UserVoiceCollectionResponseModel[]
   * The voice collections the caller can access, sorted by title.
   */
  #[
    JsonProperty('collections', required: true),
    ArrayType([\ElevenLabs\Types\UserVoiceCollectionResponseModel::class])
  ]
  public array $collections;

  /**
   * @param array{
   *   collections: \ElevenLabs\Types\UserVoiceCollectionResponseModel[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->collections = $values['collections'];

    $this->_dirtyFields = [
      'collections' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'collections',
      'contents' => json_encode($this->collections),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->collections as $item) {
      $item->validate();
    }
  }
}

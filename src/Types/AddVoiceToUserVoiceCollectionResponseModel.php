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
class AddVoiceToUserVoiceCollectionResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the voice collection.
   */
  #[JsonProperty('collection_id', required: true)]
  public string $collectionId;

  /**
   * The ID of the voice that was added.
   */
  #[JsonProperty('voice_id', required: true)]
  public string $voiceId;

  /**
   * @param array{
   *   collectionId: string,
   *   voiceId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->collectionId = $values['collectionId'];
    $this->voiceId = $values['voiceId'];

    $this->_dirtyFields = [
      'collection_id' => true,
      'voice_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'collection_id',
      'contents' => $this->collectionId
    ];

    $parts[] = [
      'name' => 'voice_id',
      'contents' => $this->voiceId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

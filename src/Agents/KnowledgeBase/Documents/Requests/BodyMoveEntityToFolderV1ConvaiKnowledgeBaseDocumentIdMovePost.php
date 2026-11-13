<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\KnowledgeBase\Documents\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyMoveEntityToFolderV1ConvaiKnowledgeBaseDocumentIdMovePost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The folder to move the entities to. If not set, the entities will be moved to the root folder.
   */
  #[JsonProperty('move_to')]
  public ?string $moveTo;

  /**
   * @param array{
   *   moveTo?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->moveTo = $values['moveTo'] ?? null;

    if (array_key_exists('moveTo', $values)) {
      $this->_dirtyFields['move_to'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->moveTo !== null) {
      $parts[] = [
        'name' => 'move_to',
        'contents' => $this->moveTo
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

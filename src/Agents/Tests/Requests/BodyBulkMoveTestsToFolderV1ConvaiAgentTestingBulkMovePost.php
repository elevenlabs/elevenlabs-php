<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Tests\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyBulkMoveTestsToFolderV1ConvaiAgentTestingBulkMovePost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   * The IDs of tests or folders to move.
   */
  #[JsonProperty('entity_ids', required: true), ArrayType(['string'])]
  public array $entityIds;

  /**
   * The folder to move the entities to. If not set, the entities will be moved to the root folder.
   */
  #[JsonProperty('move_to')]
  public ?string $moveTo;

  /**
   * @param array{
   *   entityIds: string[],
   *   moveTo?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->entityIds = $values['entityIds'];
    $this->moveTo = $values['moveTo'] ?? null;

    $this->_dirtyFields = [
      'entity_ids' => true
    ];
    if (array_key_exists('moveTo', $values)) {
      $this->_dirtyFields['move_to'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->entityIds as $item) {
      $parts[] = [
        'name' => 'entity_ids',
        'contents' => $item
      ];
    }

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
    Validator::validateArray($this->entityIds, 'entity_ids', minItems: 1, uniqueItems: true);
  }
}

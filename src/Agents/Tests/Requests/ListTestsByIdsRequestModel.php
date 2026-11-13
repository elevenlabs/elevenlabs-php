<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Tests\Requests;

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
class ListTestsByIdsRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   * List of test IDs to fetch. No duplicates allowed. Prefer at most 1000 IDs per request.
   */
  #[JsonProperty('test_ids', required: true), ArrayType(['string'])]
  public array $testIds;

  /**
   * @param array{
   *   testIds: string[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->testIds = $values['testIds'];

    $this->_dirtyFields = [
      'test_ids' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->testIds as $item) {
      $parts[] = [
        'name' => 'test_ids',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

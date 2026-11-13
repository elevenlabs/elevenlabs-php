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
class AgentKnowledgeBaseRagListingResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\AgentKnowledgeBaseRagListingEntryResponseModel[]
   * Entries the agent would be shown, folders first and then by name. Large folders are cut to the number of entries the agent is shown.
   */
  #[
    JsonProperty('entries', required: true),
    ArrayType([\ElevenLabs\Types\AgentKnowledgeBaseRagListingEntryResponseModel::class])
  ]
  public array $entries;

  /**
   * Number of entries in the listed folder, including any not returned.
   */
  #[JsonProperty('total_count', required: true)]
  public int $totalCount;

  /**
   * @param array{
   *   entries: \ElevenLabs\Types\AgentKnowledgeBaseRagListingEntryResponseModel[],
   *   totalCount: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->entries = $values['entries'];
    $this->totalCount = $values['totalCount'];

    $this->_dirtyFields = [
      'entries' => true,
      'total_count' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'entries',
      'contents' => json_encode($this->entries),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'total_count',
      'contents' => (string) $this->totalCount
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->entries as $item) {
      $item->validate();
    }
  }
}

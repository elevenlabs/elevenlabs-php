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
class GetAnalysisItemDependentAgentsResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\GetAnalysisItemDependentAgentsResponseModelAgentsItem[]
   */
  #[
    JsonProperty('agents', required: true),
    ArrayType([\ElevenLabs\Types\GetAnalysisItemDependentAgentsResponseModelAgentsItem::class])
  ]
  public array $agents;

  /**
   * @var \ElevenLabs\Types\DependentBranchInfo[]|null
   */
  #[JsonProperty('branches'), ArrayType([\ElevenLabs\Types\DependentBranchInfo::class])]
  public ?array $branches;

  #[JsonProperty('next_cursor')]
  public ?string $nextCursor;

  #[JsonProperty('has_more', required: true)]
  public bool $hasMore;

  /**
   * @param array{
   *   agents: \ElevenLabs\Types\GetAnalysisItemDependentAgentsResponseModelAgentsItem[],
   *   hasMore: bool,
   *   branches?: \ElevenLabs\Types\DependentBranchInfo[]|null,
   *   nextCursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agents = $values['agents'];
    $this->branches = $values['branches'] ?? null;
    $this->nextCursor = $values['nextCursor'] ?? null;
    $this->hasMore = $values['hasMore'];

    $this->_dirtyFields = [
      'agents' => true,
      'has_more' => true
    ];
    if (array_key_exists('branches', $values)) {
      $this->_dirtyFields['branches'] = true;
    }
    if (array_key_exists('nextCursor', $values)) {
      $this->_dirtyFields['next_cursor'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agents',
      'contents' => json_encode($this->agents),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->branches !== null) {
      $parts[] = [
        'name' => 'branches',
        'contents' => json_encode($this->branches),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->nextCursor !== null) {
      $parts[] = [
        'name' => 'next_cursor',
        'contents' => $this->nextCursor
      ];
    }

    $parts[] = [
      'name' => 'has_more',
      'contents' => $this->hasMore ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->branches ?? [] as $item) {
      $item->validate();
    }
  }
}

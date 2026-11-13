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
class GetAgentsPageResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\AgentSummaryResponseModel[]
   * A list of agents and their metadata
   */
  #[
    JsonProperty('agents', required: true),
    ArrayType([\ElevenLabs\Types\AgentSummaryResponseModel::class])
  ]
  public array $agents;

  /**
   * The next cursor to paginate through the agents
   */
  #[JsonProperty('next_cursor')]
  public ?string $nextCursor;

  /**
   * Whether there are more agents to paginate through
   */
  #[JsonProperty('has_more', required: true)]
  public bool $hasMore;

  /**
   * @param array{
   *   agents: \ElevenLabs\Types\AgentSummaryResponseModel[],
   *   hasMore: bool,
   *   nextCursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agents = $values['agents'];
    $this->nextCursor = $values['nextCursor'] ?? null;
    $this->hasMore = $values['hasMore'];

    $this->_dirtyFields = [
      'agents' => true,
      'has_more' => true
    ];
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
    foreach ($this->agents as $item) {
      $item->validate();
    }
  }
}

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
class ListResponseAgentBranchSummary extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('meta')]
  public ?\ElevenLabs\Types\ListResponseMeta $meta;

  /**
   * @var \ElevenLabs\Types\AgentBranchSummary[]
   */
  #[
    JsonProperty('results', required: true),
    ArrayType([\ElevenLabs\Types\AgentBranchSummary::class])
  ]
  public array $results;

  /**
   * @param array{
   *   results: \ElevenLabs\Types\AgentBranchSummary[],
   *   meta?: ?\ElevenLabs\Types\ListResponseMeta,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->meta = $values['meta'] ?? null;
    $this->results = $values['results'];

    $this->_dirtyFields = [
      'results' => true
    ];
    if (array_key_exists('meta', $values)) {
      $this->_dirtyFields['meta'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->meta !== null) {
      $parts[] = [
        'name' => 'meta',
        'contents' => json_encode($this->meta),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'results',
      'contents' => json_encode($this->results),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->meta?->validate();
    foreach ($this->results as $item) {
      $item->validate();
    }
  }
}

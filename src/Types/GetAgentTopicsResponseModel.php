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
class GetAgentTopicsResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\AgentTopicResponseModel[]
   */
  #[
    JsonProperty('topics', required: true),
    ArrayType([\ElevenLabs\Types\AgentTopicResponseModel::class])
  ]
  public array $topics;

  #[JsonProperty('window_start_unix_secs', required: true)]
  public int $windowStartUnixSecs;

  #[JsonProperty('window_end_unix_secs', required: true)]
  public int $windowEndUnixSecs;

  /**
   * Number of daily topic-discovery runs the returned metrics were summed over.
   */
  #[JsonProperty('aggregated_run_count')]
  public ?int $aggregatedRunCount;

  #[JsonProperty('has_more')]
  public ?bool $hasMore;

  #[JsonProperty('next_cursor')]
  public ?string $nextCursor;

  /**
   * @param array{
   *   topics: \ElevenLabs\Types\AgentTopicResponseModel[],
   *   windowStartUnixSecs: int,
   *   windowEndUnixSecs: int,
   *   aggregatedRunCount?: ?int,
   *   hasMore?: ?bool,
   *   nextCursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->topics = $values['topics'];
    $this->windowStartUnixSecs = $values['windowStartUnixSecs'];
    $this->windowEndUnixSecs = $values['windowEndUnixSecs'];
    $this->aggregatedRunCount = $values['aggregatedRunCount'] ?? null;
    $this->hasMore = $values['hasMore'] ?? null;
    $this->nextCursor = $values['nextCursor'] ?? null;

    $this->_dirtyFields = [
      'topics' => true,
      'window_start_unix_secs' => true,
      'window_end_unix_secs' => true
    ];
    if (array_key_exists('aggregatedRunCount', $values)) {
      $this->_dirtyFields['aggregated_run_count'] = true;
    }
    if (array_key_exists('hasMore', $values)) {
      $this->_dirtyFields['has_more'] = true;
    }
    if (array_key_exists('nextCursor', $values)) {
      $this->_dirtyFields['next_cursor'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'topics',
      'contents' => json_encode($this->topics),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'window_start_unix_secs',
      'contents' => (string) $this->windowStartUnixSecs
    ];

    $parts[] = [
      'name' => 'window_end_unix_secs',
      'contents' => (string) $this->windowEndUnixSecs
    ];

    if ($this->aggregatedRunCount !== null) {
      $parts[] = [
        'name' => 'aggregated_run_count',
        'contents' => (string) $this->aggregatedRunCount
      ];
    }

    if ($this->hasMore !== null) {
      $parts[] = [
        'name' => 'has_more',
        'contents' => $this->hasMore ? 'true' : 'false'
      ];
    }

    if ($this->nextCursor !== null) {
      $parts[] = [
        'name' => 'next_cursor',
        'contents' => $this->nextCursor
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->topics as $item) {
      $item->validate();
    }
  }
}

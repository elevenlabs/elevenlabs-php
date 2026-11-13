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
class WorkspaceBatchCallsResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\BatchCallResponse[]
   */
  #[
    JsonProperty('batch_calls', required: true),
    ArrayType([\ElevenLabs\Types\BatchCallResponse::class])
  ]
  public array $batchCalls;

  /**
   * The next document, used to paginate through the batch calls
   */
  #[JsonProperty('next_doc')]
  public ?string $nextDoc;

  /**
   * Whether there are more batch calls to paginate through
   */
  #[JsonProperty('has_more')]
  public ?bool $hasMore;

  /**
   * @param array{
   *   batchCalls: \ElevenLabs\Types\BatchCallResponse[],
   *   nextDoc?: ?string,
   *   hasMore?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->batchCalls = $values['batchCalls'];
    $this->nextDoc = $values['nextDoc'] ?? null;
    $this->hasMore = $values['hasMore'] ?? null;

    $this->_dirtyFields = [
      'batch_calls' => true
    ];
    if (array_key_exists('nextDoc', $values)) {
      $this->_dirtyFields['next_doc'] = true;
    }
    if (array_key_exists('hasMore', $values)) {
      $this->_dirtyFields['has_more'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'batch_calls',
      'contents' => json_encode($this->batchCalls),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->nextDoc !== null) {
      $parts[] = [
        'name' => 'next_doc',
        'contents' => $this->nextDoc
      ];
    }

    if ($this->hasMore !== null) {
      $parts[] = [
        'name' => 'has_more',
        'contents' => $this->hasMore ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->batchCalls as $item) {
      $item->validate();
    }
  }
}

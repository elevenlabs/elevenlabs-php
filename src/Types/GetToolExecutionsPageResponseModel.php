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
class GetToolExecutionsPageResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\ToolExecutionResponseModel[]
   */
  #[
    JsonProperty('executions', required: true),
    ArrayType([\ElevenLabs\Types\ToolExecutionResponseModel::class])
  ]
  public array $executions;

  #[JsonProperty('next_cursor')]
  public ?string $nextCursor;

  #[JsonProperty('has_more', required: true)]
  public bool $hasMore;

  /**
   * @param array{
   *   executions: \ElevenLabs\Types\ToolExecutionResponseModel[],
   *   hasMore: bool,
   *   nextCursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->executions = $values['executions'];
    $this->nextCursor = $values['nextCursor'] ?? null;
    $this->hasMore = $values['hasMore'];

    $this->_dirtyFields = [
      'executions' => true,
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
      'name' => 'executions',
      'contents' => json_encode($this->executions),
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
    foreach ($this->executions as $item) {
      $item->validate();
    }
  }
}

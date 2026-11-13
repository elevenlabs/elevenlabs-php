<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class KnowledgeBaseToolResultModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\KnowledgeBaseToolResultModelResultType>
   */
  #[JsonProperty('result_type')]
  public ?string $resultType;

  /**
   * @var ?value-of<\ElevenLabs\Types\KnowledgeBaseToolStatus>
   */
  #[JsonProperty('status')]
  public ?string $status;

  #[JsonProperty('chunk_count')]
  public ?int $chunkCount;

  #[JsonProperty('message')]
  public ?string $message;

  /**
   * @param array{
   *   resultType?: ?value-of<\ElevenLabs\Types\KnowledgeBaseToolResultModelResultType>,
   *   status?: ?value-of<\ElevenLabs\Types\KnowledgeBaseToolStatus>,
   *   chunkCount?: ?int,
   *   message?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->resultType = $values['resultType'] ?? 'knowledge_base_success';
    $this->status = $values['status'] ?? null;
    $this->chunkCount = $values['chunkCount'] ?? null;
    $this->message = $values['message'] ?? null;

    if (array_key_exists('resultType', $values)) {
      $this->_dirtyFields['result_type'] = true;
    }
    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
    if (array_key_exists('chunkCount', $values)) {
      $this->_dirtyFields['chunk_count'] = true;
    }
    if (array_key_exists('message', $values)) {
      $this->_dirtyFields['message'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->resultType !== null) {
      $parts[] = [
        'name' => 'result_type',
        'contents' => $this->resultType
      ];
    }

    if ($this->status !== null) {
      $parts[] = [
        'name' => 'status',
        'contents' => $this->status
      ];
    }

    if ($this->chunkCount !== null) {
      $parts[] = [
        'name' => 'chunk_count',
        'contents' => (string) $this->chunkCount
      ];
    }

    if ($this->message !== null) {
      $parts[] = [
        'name' => 'message',
        'contents' => $this->message
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

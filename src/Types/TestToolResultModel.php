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
class TestToolResultModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\TestToolResultModelResultType>
   */
  #[JsonProperty('result_type')]
  public ?string $resultType;

  /**
   * @var ?value-of<\ElevenLabs\Types\TestToolResultModelStatus>
   */
  #[JsonProperty('status')]
  public ?string $status;

  #[JsonProperty('reason')]
  public ?string $reason;

  #[JsonProperty('to_agent')]
  public ?string $toAgent;

  #[JsonProperty('to_node')]
  public ?string $toNode;

  /**
   * @param array{
   *   resultType?: ?value-of<\ElevenLabs\Types\TestToolResultModelResultType>,
   *   status?: ?value-of<\ElevenLabs\Types\TestToolResultModelStatus>,
   *   reason?: ?string,
   *   toAgent?: ?string,
   *   toNode?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->resultType = $values['resultType'] ?? 'testing_tool_result';
    $this->status = $values['status'] ?? 'success';
    $this->reason = $values['reason'] ?? null;
    $this->toAgent = $values['toAgent'] ?? null;
    $this->toNode = $values['toNode'] ?? null;

    if (array_key_exists('resultType', $values)) {
      $this->_dirtyFields['result_type'] = true;
    }
    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
    if (array_key_exists('reason', $values)) {
      $this->_dirtyFields['reason'] = true;
    }
    if (array_key_exists('toAgent', $values)) {
      $this->_dirtyFields['to_agent'] = true;
    }
    if (array_key_exists('toNode', $values)) {
      $this->_dirtyFields['to_node'] = true;
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

    if ($this->reason !== null) {
      $parts[] = [
        'name' => 'reason',
        'contents' => $this->reason
      ];
    }

    if ($this->toAgent !== null) {
      $parts[] = [
        'name' => 'to_agent',
        'contents' => $this->toAgent
      ];
    }

    if ($this->toNode !== null) {
      $parts[] = [
        'name' => 'to_node',
        'contents' => $this->toNode
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

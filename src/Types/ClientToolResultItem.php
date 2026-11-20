<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A `client_tool_result` whose `type` is required, so that it can share `input` with other items.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ClientToolResultItem extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\ClientToolResultItemType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * ID of the tool call this result corresponds to.
   */
  #[JsonProperty('tool_call_id', required: true)]
  public string $toolCallId;

  #[JsonProperty('result', required: true)]
  public string $result;

  #[JsonProperty('is_error', required: true)]
  public bool $isError;

  /**
   * @var ?value-of<\ElevenLabs\Types\ClientToolResultItemErrorType>
   * Optional category for the failure reason. When set, `is_error` is treated as true. `user_rejected` is special-cased to mark the tool as not having been called.
   */
  #[JsonProperty('error_type')]
  public ?string $errorType;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\ClientToolResultItemType>,
   *   toolCallId: string,
   *   result: string,
   *   isError: bool,
   *   errorType?: ?value-of<\ElevenLabs\Types\ClientToolResultItemErrorType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->toolCallId = $values['toolCallId'];
    $this->result = $values['result'];
    $this->isError = $values['isError'];
    $this->errorType = $values['errorType'] ?? null;

    $this->_dirtyFields = [
      'type' => true,
      'tool_call_id' => true,
      'result' => true,
      'is_error' => true
    ];
    if (array_key_exists('errorType', $values)) {
      $this->_dirtyFields['error_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'tool_call_id',
      'contents' => $this->toolCallId
    ];

    $parts[] = [
      'name' => 'result',
      'contents' => $this->result
    ];

    $parts[] = [
      'name' => 'is_error',
      'contents' => $this->isError ? 'true' : 'false'
    ];

    if ($this->errorType !== null) {
      $parts[] = [
        'name' => 'error_type',
        'contents' => $this->errorType
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

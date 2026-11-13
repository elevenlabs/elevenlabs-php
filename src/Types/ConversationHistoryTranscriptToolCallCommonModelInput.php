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
class ConversationHistoryTranscriptToolCallCommonModelInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ToolType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('request_id', required: true)]
  public string $requestId;

  #[JsonProperty('tool_name', required: true)]
  public string $toolName;

  /**
   * ID of the called tool. Not set for tools without an ID, such as system tools.
   */
  #[JsonProperty('tool_id')]
  public ?string $toolId;

  #[JsonProperty('params_as_json', required: true)]
  public string $paramsAsJson;

  #[JsonProperty('tool_has_been_called', required: true)]
  public bool $toolHasBeenCalled;

  #[JsonProperty('tool_details')]
  public ?\ElevenLabs\Types\ConversationHistoryTranscriptToolCallCommonModelInputToolDetails $toolDetails;

  /**
   * @param array{
   *   requestId: string,
   *   toolName: string,
   *   paramsAsJson: string,
   *   toolHasBeenCalled: bool,
   *   type?: ?value-of<\ElevenLabs\Types\ToolType>,
   *   toolId?: ?string,
   *   toolDetails?: ?\ElevenLabs\Types\ConversationHistoryTranscriptToolCallCommonModelInputToolDetails,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? null;
    $this->requestId = $values['requestId'];
    $this->toolName = $values['toolName'];
    $this->toolId = $values['toolId'] ?? null;
    $this->paramsAsJson = $values['paramsAsJson'];
    $this->toolHasBeenCalled = $values['toolHasBeenCalled'];
    $this->toolDetails = $values['toolDetails'] ?? null;

    $this->_dirtyFields = [
      'request_id' => true,
      'tool_name' => true,
      'params_as_json' => true,
      'tool_has_been_called' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('toolId', $values)) {
      $this->_dirtyFields['tool_id'] = true;
    }
    if (array_key_exists('toolDetails', $values)) {
      $this->_dirtyFields['tool_details'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'request_id',
      'contents' => $this->requestId
    ];

    $parts[] = [
      'name' => 'tool_name',
      'contents' => $this->toolName
    ];

    if ($this->toolId !== null) {
      $parts[] = [
        'name' => 'tool_id',
        'contents' => $this->toolId
      ];
    }

    $parts[] = [
      'name' => 'params_as_json',
      'contents' => $this->paramsAsJson
    ];

    $parts[] = [
      'name' => 'tool_has_been_called',
      'contents' => $this->toolHasBeenCalled ? 'true' : 'false'
    ];

    if ($this->toolDetails !== null) {
      $parts[] = [
        'name' => 'tool_details',
        'contents' => json_encode($this->toolDetails),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

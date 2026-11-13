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
class ToolRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Configuration for the tool
   */
  #[JsonProperty('tool_config', required: true)]
  public \ElevenLabs\Types\ToolRequestModelToolConfig $toolConfig;

  /**
   * @var \ElevenLabs\Types\ToolResponseMockConfigInput[]|null
   * Mock responses with optional parameter conditions. Evaluated top-to-bottom; first match wins.
   */
  #[
    JsonProperty('response_mocks'),
    ArrayType([\ElevenLabs\Types\ToolResponseMockConfigInput::class])
  ]
  public ?array $responseMocks;

  /**
   * @param array{
   *   toolConfig: \ElevenLabs\Types\ToolRequestModelToolConfig,
   *   responseMocks?: \ElevenLabs\Types\ToolResponseMockConfigInput[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->toolConfig = $values['toolConfig'];
    $this->responseMocks = $values['responseMocks'] ?? null;

    $this->_dirtyFields = [
      'tool_config' => true
    ];
    if (array_key_exists('responseMocks', $values)) {
      $this->_dirtyFields['response_mocks'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'tool_config',
      'contents' => json_encode($this->toolConfig),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->responseMocks !== null) {
      $parts[] = [
        'name' => 'response_mocks',
        'contents' => json_encode($this->responseMocks),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->responseMocks ?? [] as $item) {
      $item->validate();
    }
  }
}

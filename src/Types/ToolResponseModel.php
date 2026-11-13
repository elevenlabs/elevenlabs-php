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
class ToolResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * The type of tool
   */
  #[JsonProperty('tool_config', required: true)]
  public \ElevenLabs\Types\ToolResponseModelToolConfig $toolConfig;

  #[JsonProperty('access_info', required: true)]
  public \ElevenLabs\Types\ResourceAccessInfo $accessInfo;

  #[JsonProperty('usage_stats', required: true)]
  public \ElevenLabs\Types\ToolUsageStatsResponseModel $usageStats;

  /**
   * @var \ElevenLabs\Types\ToolResponseMockConfigOutput[]|null
   * Mock responses with optional parameter conditions. Evaluated top-to-bottom; first match wins.
   */
  #[
    JsonProperty('response_mocks'),
    ArrayType([\ElevenLabs\Types\ToolResponseMockConfigOutput::class])
  ]
  public ?array $responseMocks;

  /**
   * @param array{
   *   id: string,
   *   toolConfig: \ElevenLabs\Types\ToolResponseModelToolConfig,
   *   accessInfo: \ElevenLabs\Types\ResourceAccessInfo,
   *   usageStats: \ElevenLabs\Types\ToolUsageStatsResponseModel,
   *   responseMocks?: \ElevenLabs\Types\ToolResponseMockConfigOutput[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->toolConfig = $values['toolConfig'];
    $this->accessInfo = $values['accessInfo'];
    $this->usageStats = $values['usageStats'];
    $this->responseMocks = $values['responseMocks'] ?? null;

    $this->_dirtyFields = [
      'id' => true,
      'tool_config' => true,
      'access_info' => true,
      'usage_stats' => true
    ];
    if (array_key_exists('responseMocks', $values)) {
      $this->_dirtyFields['response_mocks'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'tool_config',
      'contents' => json_encode($this->toolConfig),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'access_info',
      'contents' => json_encode($this->accessInfo),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'usage_stats',
      'contents' => json_encode($this->usageStats),
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
    $this->accessInfo->validate();
    $this->usageStats->validate();
    foreach ($this->responseMocks ?? [] as $item) {
      $item->validate();
    }
  }
}

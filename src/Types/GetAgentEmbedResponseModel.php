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
class GetAgentEmbedResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('widget_config', required: true)]
  public \ElevenLabs\Types\WidgetConfigResponse $widgetConfig;

  /**
   * @param array{
   *   agentId: string,
   *   widgetConfig: \ElevenLabs\Types\WidgetConfigResponse,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'];
    $this->widgetConfig = $values['widgetConfig'];

    $this->_dirtyFields = [
      'agent_id' => true,
      'widget_config' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'agent_id',
      'contents' => $this->agentId
    ];

    $parts[] = [
      'name' => 'widget_config',
      'contents' => json_encode($this->widgetConfig),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->widgetConfig->validate();
  }
}

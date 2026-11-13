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
class WorkflowFeaturesUsageCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('enabled')]
  public ?bool $enabled;

  #[JsonProperty('tool_node')]
  public ?\ElevenLabs\Types\FeatureStatusCommonModel $toolNode;

  #[JsonProperty('standalone_agent_node')]
  public ?\ElevenLabs\Types\FeatureStatusCommonModel $standaloneAgentNode;

  #[JsonProperty('phone_number_node')]
  public ?\ElevenLabs\Types\FeatureStatusCommonModel $phoneNumberNode;

  #[JsonProperty('end_node')]
  public ?\ElevenLabs\Types\FeatureStatusCommonModel $endNode;

  #[JsonProperty('override_agent_node')]
  public ?\ElevenLabs\Types\FeatureStatusCommonModel $overrideAgentNode;

  /**
   * @param array{
   *   enabled?: ?bool,
   *   toolNode?: ?\ElevenLabs\Types\FeatureStatusCommonModel,
   *   standaloneAgentNode?: ?\ElevenLabs\Types\FeatureStatusCommonModel,
   *   phoneNumberNode?: ?\ElevenLabs\Types\FeatureStatusCommonModel,
   *   endNode?: ?\ElevenLabs\Types\FeatureStatusCommonModel,
   *   overrideAgentNode?: ?\ElevenLabs\Types\FeatureStatusCommonModel,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->enabled = $values['enabled'] ?? null;
    $this->toolNode = $values['toolNode'] ?? null;
    $this->standaloneAgentNode = $values['standaloneAgentNode'] ?? null;
    $this->phoneNumberNode = $values['phoneNumberNode'] ?? null;
    $this->endNode = $values['endNode'] ?? null;
    $this->overrideAgentNode = $values['overrideAgentNode'] ?? null;

    if (array_key_exists('enabled', $values)) {
      $this->_dirtyFields['enabled'] = true;
    }
    if (array_key_exists('toolNode', $values)) {
      $this->_dirtyFields['tool_node'] = true;
    }
    if (array_key_exists('standaloneAgentNode', $values)) {
      $this->_dirtyFields['standalone_agent_node'] = true;
    }
    if (array_key_exists('phoneNumberNode', $values)) {
      $this->_dirtyFields['phone_number_node'] = true;
    }
    if (array_key_exists('endNode', $values)) {
      $this->_dirtyFields['end_node'] = true;
    }
    if (array_key_exists('overrideAgentNode', $values)) {
      $this->_dirtyFields['override_agent_node'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->enabled !== null) {
      $parts[] = [
        'name' => 'enabled',
        'contents' => $this->enabled ? 'true' : 'false'
      ];
    }

    if ($this->toolNode !== null) {
      $parts[] = [
        'name' => 'tool_node',
        'contents' => json_encode($this->toolNode),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->standaloneAgentNode !== null) {
      $parts[] = [
        'name' => 'standalone_agent_node',
        'contents' => json_encode($this->standaloneAgentNode),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->phoneNumberNode !== null) {
      $parts[] = [
        'name' => 'phone_number_node',
        'contents' => json_encode($this->phoneNumberNode),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->endNode !== null) {
      $parts[] = [
        'name' => 'end_node',
        'contents' => json_encode($this->endNode),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->overrideAgentNode !== null) {
      $parts[] = [
        'name' => 'override_agent_node',
        'contents' => json_encode($this->overrideAgentNode),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->toolNode?->validate();
    $this->standaloneAgentNode?->validate();
    $this->phoneNumberNode?->validate();
    $this->endNode?->validate();
    $this->overrideAgentNode?->validate();
  }
}

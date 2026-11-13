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
class AdhocAgentConfigOverrideForTestRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('conversation_config', required: true)]
  public \ElevenLabs\Types\ConversationalConfig $conversationConfig;

  #[JsonProperty('platform_settings', required: true)]
  public \ElevenLabs\Types\AgentPlatformSettingsRequestModel $platformSettings;

  #[JsonProperty('workflow')]
  public ?\ElevenLabs\Types\AgentWorkflowRequestModel $workflow;

  /**
   * @param array{
   *   conversationConfig: \ElevenLabs\Types\ConversationalConfig,
   *   platformSettings: \ElevenLabs\Types\AgentPlatformSettingsRequestModel,
   *   workflow?: ?\ElevenLabs\Types\AgentWorkflowRequestModel,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->conversationConfig = $values['conversationConfig'];
    $this->platformSettings = $values['platformSettings'];
    $this->workflow = $values['workflow'] ?? null;

    $this->_dirtyFields = [
      'conversation_config' => true,
      'platform_settings' => true
    ];
    if (array_key_exists('workflow', $values)) {
      $this->_dirtyFields['workflow'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'conversation_config',
      'contents' => json_encode($this->conversationConfig),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'platform_settings',
      'contents' => json_encode($this->platformSettings),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->workflow !== null) {
      $parts[] = [
        'name' => 'workflow',
        'contents' => json_encode($this->workflow),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->conversationConfig->validate();
    $this->platformSettings->validate();
    $this->workflow?->validate();
  }
}

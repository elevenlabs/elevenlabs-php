<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Requests;

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
class BodyCreateAgentV1ConvaiAgentsCreatePost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Deprecated: all agents are versioned. This parameter is ignored.
   */
  public ?bool $enableVersioning;

  #[JsonProperty('conversation_config', required: true)]
  public \ElevenLabs\Types\ConversationalConfig $conversationConfig;

  /**
   * Platform settings for the agent are all settings that aren't related to the conversation orchestration and content.
   */
  #[JsonProperty('platform_settings')]
  public ?\ElevenLabs\Types\AgentPlatformSettingsRequestModel $platformSettings;

  #[JsonProperty('workflow')]
  public ?\ElevenLabs\Types\AgentWorkflowRequestModel $workflow;

  /**
   * A name to make the agent easier to find
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * @var string[]|null
   * Tags to help classify and filter the agent
   */
  #[JsonProperty('tags'), ArrayType(['string'])]
  public ?array $tags;

  /**
   * @param array{
   *   conversationConfig: \ElevenLabs\Types\ConversationalConfig,
   *   enableVersioning?: ?bool,
   *   platformSettings?: ?\ElevenLabs\Types\AgentPlatformSettingsRequestModel,
   *   workflow?: ?\ElevenLabs\Types\AgentWorkflowRequestModel,
   *   name?: ?string,
   *   tags?: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->enableVersioning = $values['enableVersioning'] ?? null;
    $this->conversationConfig = $values['conversationConfig'];
    $this->platformSettings = $values['platformSettings'] ?? null;
    $this->workflow = $values['workflow'] ?? null;
    $this->name = $values['name'] ?? null;
    $this->tags = $values['tags'] ?? null;

    $this->_dirtyFields = [
      'conversation_config' => true
    ];
    if (array_key_exists('platformSettings', $values)) {
      $this->_dirtyFields['platform_settings'] = true;
    }
    if (array_key_exists('workflow', $values)) {
      $this->_dirtyFields['workflow'] = true;
    }
    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('tags', $values)) {
      $this->_dirtyFields['tags'] = true;
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

    if ($this->platformSettings !== null) {
      $parts[] = [
        'name' => 'platform_settings',
        'contents' => json_encode($this->platformSettings),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->workflow !== null) {
      $parts[] = [
        'name' => 'workflow',
        'contents' => json_encode($this->workflow),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->tags !== null) {
      foreach ($this->tags ?? [] as $item) {
        $parts[] = [
          'name' => 'tags',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->conversationConfig->validate();
    $this->platformSettings?->validate();
    $this->workflow?->validate();
  }
}

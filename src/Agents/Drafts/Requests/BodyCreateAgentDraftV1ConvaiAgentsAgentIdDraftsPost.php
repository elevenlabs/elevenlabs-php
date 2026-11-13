<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Drafts\Requests;

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
class BodyCreateAgentDraftV1ConvaiAgentsAgentIdDraftsPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the agent branch to use
   */
  public string $branchId;

  /**
   * @var array<string, mixed>
   * Conversation config for the draft
   */
  #[JsonProperty('conversation_config', required: true), ArrayType(['string' => 'mixed'])]
  public array $conversationConfig;

  /**
   * @var array<string, mixed>
   * Platform settings for the draft
   */
  #[JsonProperty('platform_settings', required: true), ArrayType(['string' => 'mixed'])]
  public array $platformSettings;

  #[JsonProperty('workflow', required: true)]
  public \ElevenLabs\Types\AgentWorkflowRequestModel $workflow;

  /**
   * Name for the draft
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * @var string[]|null
   * Tags to help classify and filter the agent
   */
  #[JsonProperty('tags'), ArrayType(['string'])]
  public ?array $tags;

  /**
   * @param array{
   *   branchId: string,
   *   conversationConfig: array<string, mixed>,
   *   platformSettings: array<string, mixed>,
   *   workflow: \ElevenLabs\Types\AgentWorkflowRequestModel,
   *   name: string,
   *   tags?: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->branchId = $values['branchId'];
    $this->conversationConfig = $values['conversationConfig'];
    $this->platformSettings = $values['platformSettings'];
    $this->workflow = $values['workflow'];
    $this->name = $values['name'];
    $this->tags = $values['tags'] ?? null;

    $this->_dirtyFields = [
      'conversation_config' => true,
      'platform_settings' => true,
      'workflow' => true,
      'name' => true
    ];
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

    $parts[] = [
      'name' => 'platform_settings',
      'contents' => json_encode($this->platformSettings),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'workflow',
      'contents' => json_encode($this->workflow),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

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
    $this->workflow->validate();
  }
}

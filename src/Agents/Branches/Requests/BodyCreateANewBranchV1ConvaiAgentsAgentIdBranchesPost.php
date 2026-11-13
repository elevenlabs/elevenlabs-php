<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Branches\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyCreateANewBranchV1ConvaiAgentsAgentIdBranchesPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of the version to branch from
   */
  #[JsonProperty('parent_version_id', required: true)]
  public string $parentVersionId;

  /**
   * Name of the branch. It is unique within the agent.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * Description for the branch
   */
  #[JsonProperty('description', required: true)]
  public string $description;

  /**
   * @var array<string, mixed>|null
   * Changes to apply to conversation config
   */
  #[JsonProperty('conversation_config'), ArrayType(['string' => 'mixed'])]
  public ?array $conversationConfig;

  /**
   * @var array<string, mixed>|null
   * Changes to apply to platform settings
   */
  #[JsonProperty('platform_settings'), ArrayType(['string' => 'mixed'])]
  public ?array $platformSettings;

  /**
   * Updated workflow definition
   */
  #[JsonProperty('workflow')]
  public ?\ElevenLabs\Types\AgentWorkflowRequestModel $workflow;

  /**
   * When true, the new branch uses the caller's draft procedure set instead of the branch tip. Requires parent_version_id to be the branch tip.
   */
  #[JsonProperty('include_draft')]
  public ?bool $includeDraft;

  /**
   * @param array{
   *   parentVersionId: string,
   *   name: string,
   *   description: string,
   *   conversationConfig?: array<string, mixed>|null,
   *   platformSettings?: array<string, mixed>|null,
   *   workflow?: ?\ElevenLabs\Types\AgentWorkflowRequestModel,
   *   includeDraft?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->parentVersionId = $values['parentVersionId'];
    $this->name = $values['name'];
    $this->description = $values['description'];
    $this->conversationConfig = $values['conversationConfig'] ?? null;
    $this->platformSettings = $values['platformSettings'] ?? null;
    $this->workflow = $values['workflow'] ?? null;
    $this->includeDraft = $values['includeDraft'] ?? null;

    $this->_dirtyFields = [
      'parent_version_id' => true,
      'name' => true,
      'description' => true
    ];
    if (array_key_exists('conversationConfig', $values)) {
      $this->_dirtyFields['conversation_config'] = true;
    }
    if (array_key_exists('platformSettings', $values)) {
      $this->_dirtyFields['platform_settings'] = true;
    }
    if (array_key_exists('workflow', $values)) {
      $this->_dirtyFields['workflow'] = true;
    }
    if (array_key_exists('includeDraft', $values)) {
      $this->_dirtyFields['include_draft'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'parent_version_id',
      'contents' => $this->parentVersionId
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'description',
      'contents' => $this->description
    ];

    if ($this->conversationConfig !== null) {
      $parts[] = [
        'name' => 'conversation_config',
        'contents' => json_encode($this->conversationConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

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

    if ($this->includeDraft !== null) {
      $parts[] = [
        'name' => 'include_draft',
        'contents' => $this->includeDraft ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->name, 'name', maxLength: 140);
    Validator::validateString($this->description, 'description', maxLength: 4096);
    $this->workflow?->validate();
  }
}

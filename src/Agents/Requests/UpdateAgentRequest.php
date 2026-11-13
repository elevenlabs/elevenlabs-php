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
class UpdateAgentRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Deprecated: all agents are versioned. This parameter is ignored.
   */
  public ?bool $enableVersioningIfNotEnabled;

  /**
   * The ID of the branch to use
   */
  public ?string $branchId;

  /**
   * Whether to include the workflow nodes and edges generated from structured procedures. When false, the workflow contains only authored elements.
   */
  public ?bool $includeProcedureGeneratedWorkflowElements;

  #[JsonProperty('conversation_config')]
  public ?\ElevenLabs\Types\ConversationalConfig $conversationConfig;

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
   * Description for this version when publishing changes (only applicable for versioned agents)
   */
  #[JsonProperty('version_description')]
  public ?string $versionDescription;

  /**
   * @var array<string, \ElevenLabs\Types\ProcedureVersionRef>|null
   * Procedure versions to publish, keyed by procedure_id. When provided, this map replaces the procedures from the current draft or branch tip. When omitted or null, unpublished procedure edits are used if present; otherwise, the branch tip's procedures are retained. Pass an empty object to remove all procedures.
   */
  #[
    JsonProperty('procedures'),
    ArrayType(['string' => \ElevenLabs\Types\ProcedureVersionRef::class])
  ]
  public ?array $procedures;

  /**
   * @param array{
   *   enableVersioningIfNotEnabled?: ?bool,
   *   branchId?: ?string,
   *   includeProcedureGeneratedWorkflowElements?: ?bool,
   *   conversationConfig?: ?\ElevenLabs\Types\ConversationalConfig,
   *   platformSettings?: ?\ElevenLabs\Types\AgentPlatformSettingsRequestModel,
   *   workflow?: ?\ElevenLabs\Types\AgentWorkflowRequestModel,
   *   name?: ?string,
   *   tags?: string[]|null,
   *   versionDescription?: ?string,
   *   procedures?: array<string, \ElevenLabs\Types\ProcedureVersionRef>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->enableVersioningIfNotEnabled = $values['enableVersioningIfNotEnabled'] ?? null;
    $this->branchId = $values['branchId'] ?? null;
    $this->includeProcedureGeneratedWorkflowElements =
      $values['includeProcedureGeneratedWorkflowElements'] ?? null;
    $this->conversationConfig = $values['conversationConfig'] ?? null;
    $this->platformSettings = $values['platformSettings'] ?? null;
    $this->workflow = $values['workflow'] ?? null;
    $this->name = $values['name'] ?? null;
    $this->tags = $values['tags'] ?? null;
    $this->versionDescription = $values['versionDescription'] ?? null;
    $this->procedures = $values['procedures'] ?? null;

    if (array_key_exists('conversationConfig', $values)) {
      $this->_dirtyFields['conversation_config'] = true;
    }
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
    if (array_key_exists('versionDescription', $values)) {
      $this->_dirtyFields['version_description'] = true;
    }
    if (array_key_exists('procedures', $values)) {
      $this->_dirtyFields['procedures'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
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

    if ($this->versionDescription !== null) {
      $parts[] = [
        'name' => 'version_description',
        'contents' => $this->versionDescription
      ];
    }

    if ($this->procedures !== null) {
      $parts[] = [
        'name' => 'procedures',
        'contents' => json_encode($this->procedures),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->conversationConfig?->validate();
    $this->platformSettings?->validate();
    $this->workflow?->validate();
  }
}

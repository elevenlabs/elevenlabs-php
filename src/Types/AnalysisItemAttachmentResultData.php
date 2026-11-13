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
class AnalysisItemAttachmentResultData extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('agent_id', required: true)]
  public string $agentId;

  #[JsonProperty('branch_id', required: true)]
  public string $branchId;

  /**
   * @var value-of<\ElevenLabs\Types\AnalysisItemAttachmentAction>
   */
  #[JsonProperty('action', required: true)]
  public string $action;

  #[JsonProperty('changed', required: true)]
  public bool $changed;

  /**
   * @param array{
   *   agentId: string,
   *   branchId: string,
   *   action: value-of<\ElevenLabs\Types\AnalysisItemAttachmentAction>,
   *   changed: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->agentId = $values['agentId'];
    $this->branchId = $values['branchId'];
    $this->action = $values['action'];
    $this->changed = $values['changed'];

    $this->_dirtyFields = [
      'agent_id' => true,
      'branch_id' => true,
      'action' => true,
      'changed' => true
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
      'name' => 'branch_id',
      'contents' => $this->branchId
    ];

    $parts[] = [
      'name' => 'action',
      'contents' => $this->action
    ];

    $parts[] = [
      'name' => 'changed',
      'contents' => $this->changed ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

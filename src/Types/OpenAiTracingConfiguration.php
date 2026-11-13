<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Only ``group_id`` is acted on; ``workflow_name`` and ``metadata`` are kept so the echoed session matches the request.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class OpenAiTracingConfiguration extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Adds conversation to the group (case-insensitive, up to 64 chars).
   */
  #[JsonProperty('group_id')]
  public ?string $groupId;

  #[JsonProperty('workflow_name')]
  public ?string $workflowName;

  /**
   * @var array<string, mixed>|null
   */
  #[JsonProperty('metadata'), ArrayType(['string' => 'mixed'])]
  public ?array $metadata;

  /**
   * @param array{
   *   groupId?: ?string,
   *   workflowName?: ?string,
   *   metadata?: array<string, mixed>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->groupId = $values['groupId'] ?? null;
    $this->workflowName = $values['workflowName'] ?? null;
    $this->metadata = $values['metadata'] ?? null;

    if (array_key_exists('groupId', $values)) {
      $this->_dirtyFields['group_id'] = true;
    }
    if (array_key_exists('workflowName', $values)) {
      $this->_dirtyFields['workflow_name'] = true;
    }
    if (array_key_exists('metadata', $values)) {
      $this->_dirtyFields['metadata'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->groupId !== null) {
      $parts[] = [
        'name' => 'group_id',
        'contents' => $this->groupId
      ];
    }

    if ($this->workflowName !== null) {
      $parts[] = [
        'name' => 'workflow_name',
        'contents' => $this->workflowName
      ];
    }

    if ($this->metadata !== null) {
      $parts[] = [
        'name' => 'metadata',
        'contents' => json_encode($this->metadata),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

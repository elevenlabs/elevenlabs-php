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
class ProcedureRefResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Procedure ID
   */
  #[JsonProperty('procedure_id', required: true)]
  public string $procedureId;

  /**
   * Version ID of a version of the procedure. None for a procedure never versioned.
   */
  #[JsonProperty('version_id')]
  public ?string $versionId;

  /**
   * Procedure name
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * @var ?value-of<\ElevenLabs\Types\ProcedureType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * When the agent should use this procedure. Empty string means this is a sub-procedure that should only start when another procedure references it.
   */
  #[JsonProperty('trigger')]
  public ?string $trigger;

  /**
   * @var string[]|null
   * Tool IDs referenced in the procedure content
   */
  #[JsonProperty('referenced_tool_ids'), ArrayType(['string'])]
  public ?array $referencedToolIds;

  /**
   * @var string[]|null
   * Knowledge base IDs referenced in the procedure content
   */
  #[JsonProperty('referenced_kb_ids'), ArrayType(['string'])]
  public ?array $referencedKbIds;

  /**
   * @var string[]|null
   * Procedure IDs referenced in the procedure content
   */
  #[JsonProperty('referenced_procedure_ids'), ArrayType(['string'])]
  public ?array $referencedProcedureIds;

  /**
   * @var string[]|null
   * Dynamic variable names used in the procedure content
   */
  #[JsonProperty('referenced_dynamic_variables'), ArrayType(['string'])]
  public ?array $referencedDynamicVariables;

  /**
   * Procedure ID of the folder this procedure is placed in. None means root.
   */
  #[JsonProperty('folder_parent_id')]
  public ?string $folderParentId;

  /**
   * @param array{
   *   procedureId: string,
   *   versionId?: ?string,
   *   name?: ?string,
   *   type?: ?value-of<\ElevenLabs\Types\ProcedureType>,
   *   trigger?: ?string,
   *   referencedToolIds?: string[]|null,
   *   referencedKbIds?: string[]|null,
   *   referencedProcedureIds?: string[]|null,
   *   referencedDynamicVariables?: string[]|null,
   *   folderParentId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->procedureId = $values['procedureId'];
    $this->versionId = $values['versionId'] ?? null;
    $this->name = $values['name'] ?? null;
    $this->type = $values['type'] ?? null;
    $this->trigger = $values['trigger'] ?? null;
    $this->referencedToolIds = $values['referencedToolIds'] ?? null;
    $this->referencedKbIds = $values['referencedKbIds'] ?? null;
    $this->referencedProcedureIds = $values['referencedProcedureIds'] ?? null;
    $this->referencedDynamicVariables = $values['referencedDynamicVariables'] ?? null;
    $this->folderParentId = $values['folderParentId'] ?? null;

    $this->_dirtyFields = [
      'procedure_id' => true
    ];
    if (array_key_exists('versionId', $values)) {
      $this->_dirtyFields['version_id'] = true;
    }
    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('trigger', $values)) {
      $this->_dirtyFields['trigger'] = true;
    }
    if (array_key_exists('referencedToolIds', $values)) {
      $this->_dirtyFields['referenced_tool_ids'] = true;
    }
    if (array_key_exists('referencedKbIds', $values)) {
      $this->_dirtyFields['referenced_kb_ids'] = true;
    }
    if (array_key_exists('referencedProcedureIds', $values)) {
      $this->_dirtyFields['referenced_procedure_ids'] = true;
    }
    if (array_key_exists('referencedDynamicVariables', $values)) {
      $this->_dirtyFields['referenced_dynamic_variables'] = true;
    }
    if (array_key_exists('folderParentId', $values)) {
      $this->_dirtyFields['folder_parent_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'procedure_id',
      'contents' => $this->procedureId
    ];

    if ($this->versionId !== null) {
      $parts[] = [
        'name' => 'version_id',
        'contents' => $this->versionId
      ];
    }

    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    if ($this->trigger !== null) {
      $parts[] = [
        'name' => 'trigger',
        'contents' => $this->trigger
      ];
    }

    if ($this->referencedToolIds !== null) {
      foreach ($this->referencedToolIds ?? [] as $item) {
        $parts[] = [
          'name' => 'referenced_tool_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->referencedKbIds !== null) {
      foreach ($this->referencedKbIds ?? [] as $item) {
        $parts[] = [
          'name' => 'referenced_kb_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->referencedProcedureIds !== null) {
      foreach ($this->referencedProcedureIds ?? [] as $item) {
        $parts[] = [
          'name' => 'referenced_procedure_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->referencedDynamicVariables !== null) {
      foreach ($this->referencedDynamicVariables ?? [] as $item) {
        $parts[] = [
          'name' => 'referenced_dynamic_variables',
          'contents' => $item
        ];
      }
    }

    if ($this->folderParentId !== null) {
      $parts[] = [
        'name' => 'folder_parent_id',
        'contents' => $this->folderParentId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

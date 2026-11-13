<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ProcedureAtVersionResponseModel extends JsonSerializableType
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
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * Procedure content
   */
  #[JsonProperty('content', required: true)]
  public string $content;

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
   * Procedure ID of the folder this procedure is placed in. None means root.
   */
  #[JsonProperty('folder_parent_id')]
  public ?string $folderParentId;

  /**
   * @param array{
   *   procedureId: string,
   *   name: string,
   *   content: string,
   *   versionId?: ?string,
   *   type?: ?value-of<\ElevenLabs\Types\ProcedureType>,
   *   trigger?: ?string,
   *   folderParentId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->procedureId = $values['procedureId'];
    $this->versionId = $values['versionId'] ?? null;
    $this->name = $values['name'];
    $this->content = $values['content'];
    $this->type = $values['type'] ?? null;
    $this->trigger = $values['trigger'] ?? null;
    $this->folderParentId = $values['folderParentId'] ?? null;

    $this->_dirtyFields = [
      'procedure_id' => true,
      'name' => true,
      'content' => true
    ];
    if (array_key_exists('versionId', $values)) {
      $this->_dirtyFields['version_id'] = true;
    }
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('trigger', $values)) {
      $this->_dirtyFields['trigger'] = true;
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

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'content',
      'contents' => $this->content
    ];

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
    Validator::validateString($this->name, 'name', maxLength: 200);
    Validator::validateString($this->content, 'content', maxLength: 50000);
  }
}

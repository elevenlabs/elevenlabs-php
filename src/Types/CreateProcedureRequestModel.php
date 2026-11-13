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
class CreateProcedureRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Procedure name
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * Initial procedure content
   */
  #[JsonProperty('content')]
  public ?string $content;

  /**
   * @var ?value-of<\ElevenLabs\Types\ProcedureType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * When the agent should use this procedure. Empty string means this is a sub-procedure that should only start when another procedure references it. Omit this field (or send null) to keep the stored trigger, which is empty on create. Send `""` to clear it. `description` is accepted as an alias.
   */
  #[JsonProperty('trigger')]
  public ?string $trigger;

  /**
   * Procedure ID of the folder to create this procedure in, or null for root.
   */
  #[JsonProperty('folder_parent_id')]
  public ?string $folderParentId;

  /**
   * @param array{
   *   name?: ?string,
   *   content?: ?string,
   *   type?: ?value-of<\ElevenLabs\Types\ProcedureType>,
   *   trigger?: ?string,
   *   folderParentId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->name = $values['name'] ?? null;
    $this->content = $values['content'] ?? null;
    $this->type = $values['type'] ?? null;
    $this->trigger = $values['trigger'] ?? null;
    $this->folderParentId = $values['folderParentId'] ?? null;

    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('content', $values)) {
      $this->_dirtyFields['content'] = true;
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
    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->content !== null) {
      $parts[] = [
        'name' => 'content',
        'contents' => $this->content
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
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Procedures\Drafts\Requests;

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
class UpdateProcedureDraftRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

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
   * @var value-of<\ElevenLabs\Types\ProcedureType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * When the agent should use this procedure. Empty string means this is a sub-procedure that should only start when another procedure references it. Omit this field (or send null) to keep the stored trigger, which is empty on create. Send `""` to clear it. `description` is accepted as an alias.
   */
  #[JsonProperty('trigger')]
  public ?string $trigger;

  /**
   * @param array{
   *   name: string,
   *   content: string,
   *   type: value-of<\ElevenLabs\Types\ProcedureType>,
   *   trigger?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->content = $values['content'];
    $this->type = $values['type'];
    $this->trigger = $values['trigger'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'content' => true,
      'type' => true
    ];
    if (array_key_exists('trigger', $values)) {
      $this->_dirtyFields['trigger'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'content',
      'contents' => $this->content
    ];

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    if ($this->trigger !== null) {
      $parts[] = [
        'name' => 'trigger',
        'contents' => $this->trigger
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

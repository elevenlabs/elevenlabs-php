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
class WorkflowResultConditionModelOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Optional human-readable label for the condition used throughout the UI.
   */
  #[JsonProperty('label', required: true)]
  public ?string $label;

  /**
   * @var value-of<\ElevenLabs\Types\WorkflowResultConditionModelOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * Whether all tools in the previously executed tool node were executed successfully.
   */
  #[JsonProperty('successful', required: true)]
  public bool $successful;

  /**
   * @param array{
   *   label: ?string,
   *   type: value-of<\ElevenLabs\Types\WorkflowResultConditionModelOutputType>,
   *   successful: bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->label = $values['label'];
    $this->type = $values['type'];
    $this->successful = $values['successful'];

    $this->_dirtyFields = [
      'label' => true,
      'type' => true,
      'successful' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'label',
      'contents' => $this->label
    ];

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'successful',
      'contents' => $this->successful ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

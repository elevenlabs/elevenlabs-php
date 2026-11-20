<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * A question the receptionist asks before booking or ordering this item.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionIntakeQuestion extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Stable identifier referenced by stored answers. Survives label edits so history stays attributable to the right question.
   */
  #[JsonProperty('id')]
  public ?string $id;

  #[JsonProperty('label', required: true)]
  public string $label;

  /**
   * @var ?value-of<\ElevenLabs\Types\IntakeQuestionKind>
   * Answer shape for a per-item intake question.
   */
  #[JsonProperty('kind')]
  public ?string $kind;

  /**
   * @var string[]|null
   * Allowed answers for `kind='choice'`. Must be empty for the other kinds.
   */
  #[JsonProperty('options'), ArrayType(['string'])]
  public ?array $options;

  /**
   * Enforced on the booking page. On calls the receptionist asks, but still books if the caller won't answer.
   */
  #[JsonProperty('required')]
  public ?bool $required;

  /**
   * Retired questions are deactivated rather than deleted, so answers already stored against them keep resolving.
   */
  #[JsonProperty('is_active')]
  public ?bool $isActive;

  /**
   * @param array{
   *   label: string,
   *   id?: ?string,
   *   kind?: ?value-of<\ElevenLabs\Types\IntakeQuestionKind>,
   *   options?: string[]|null,
   *   required?: ?bool,
   *   isActive?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'] ?? null;
    $this->label = $values['label'];
    $this->kind = $values['kind'] ?? null;
    $this->options = $values['options'] ?? null;
    $this->required = $values['required'] ?? null;
    $this->isActive = $values['isActive'] ?? null;

    $this->_dirtyFields = [
      'label' => true
    ];
    if (array_key_exists('id', $values)) {
      $this->_dirtyFields['id'] = true;
    }
    if (array_key_exists('kind', $values)) {
      $this->_dirtyFields['kind'] = true;
    }
    if (array_key_exists('options', $values)) {
      $this->_dirtyFields['options'] = true;
    }
    if (array_key_exists('required', $values)) {
      $this->_dirtyFields['required'] = true;
    }
    if (array_key_exists('isActive', $values)) {
      $this->_dirtyFields['is_active'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->id !== null) {
      $parts[] = [
        'name' => 'id',
        'contents' => $this->id
      ];
    }

    $parts[] = [
      'name' => 'label',
      'contents' => $this->label
    ];

    if ($this->kind !== null) {
      $parts[] = [
        'name' => 'kind',
        'contents' => $this->kind
      ];
    }

    if ($this->options !== null) {
      foreach ($this->options ?? [] as $item) {
        $parts[] = [
          'name' => 'options',
          'contents' => $item
        ];
      }
    }

    if ($this->required !== null) {
      $parts[] = [
        'name' => 'required',
        'contents' => $this->required ? 'true' : 'false'
      ];
    }

    if ($this->isActive !== null) {
      $parts[] = [
        'name' => 'is_active',
        'contents' => $this->isActive ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->options, 'options', maxItems: 20);
  }
}

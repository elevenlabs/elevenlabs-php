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
class ConflictResolution extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * `id` of the conflict this resolves, as the merge or rebase preview reported it.
   */
  #[JsonProperty('conflict_id', required: true)]
  public string $conflictId;

  /**
   * @var value-of<\ElevenLabs\Types\ConflictResolutionChoice>
   */
  #[JsonProperty('choice', required: true)]
  public string $choice;

  /**
   * Text to keep when `choice` is `custom`, or for a procedure conflict the id of the procedure version to pin. Only conflicts with `accepts_custom_value` take one.
   */
  #[JsonProperty('custom_value')]
  public ?string $customValue;

  /**
   * @param array{
   *   conflictId: string,
   *   choice: value-of<\ElevenLabs\Types\ConflictResolutionChoice>,
   *   customValue?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->conflictId = $values['conflictId'];
    $this->choice = $values['choice'];
    $this->customValue = $values['customValue'] ?? null;

    $this->_dirtyFields = [
      'conflict_id' => true,
      'choice' => true
    ];
    if (array_key_exists('customValue', $values)) {
      $this->_dirtyFields['custom_value'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'conflict_id',
      'contents' => $this->conflictId
    ];

    $parts[] = [
      'name' => 'choice',
      'contents' => $this->choice
    ];

    if ($this->customValue !== null) {
      $parts[] = [
        'name' => 'custom_value',
        'contents' => $this->customValue
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->customValue, 'custom_value', maxLength: 1000000);
  }
}

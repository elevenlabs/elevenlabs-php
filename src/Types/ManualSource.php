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
class ManualSource extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ManualSourceType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('created_by_user_id', required: true)]
  public string $createdByUserId;

  #[JsonProperty('notes')]
  public ?string $notes;

  /**
   * @param array{
   *   createdByUserId: string,
   *   type?: ?value-of<\ElevenLabs\Types\ManualSourceType>,
   *   notes?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'manual';
    $this->createdByUserId = $values['createdByUserId'];
    $this->notes = $values['notes'] ?? null;

    $this->_dirtyFields = [
      'created_by_user_id' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('notes', $values)) {
      $this->_dirtyFields['notes'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'created_by_user_id',
      'contents' => $this->createdByUserId
    ];

    if ($this->notes !== null) {
      $parts[] = [
        'name' => 'notes',
        'contents' => $this->notes
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

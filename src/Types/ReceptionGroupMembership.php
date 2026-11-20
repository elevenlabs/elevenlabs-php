<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * Membership of an item in a single user-defined group, with its display rank inside that group.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionGroupMembership extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('label', required: true)]
  public string $label;

  /**
   * 0-based display position within this group. Change it with the reorder endpoint; send back the value you read to keep the order, a membership sent without it goes to position 0.
   */
  #[JsonProperty('rank')]
  public ?int $rank;

  /**
   * @param array{
   *   label: string,
   *   rank?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->label = $values['label'];
    $this->rank = $values['rank'] ?? null;

    $this->_dirtyFields = [
      'label' => true
    ];
    if (array_key_exists('rank', $values)) {
      $this->_dirtyFields['rank'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'label',
      'contents' => $this->label
    ];

    if ($this->rank !== null) {
      $parts[] = [
        'name' => 'rank',
        'contents' => (string) $this->rank
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->rank, 'rank', min: 0);
  }
}

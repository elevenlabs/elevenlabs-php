<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Wrapper for anyOf/allOf composition constraints scoped to required fields.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class RequiredConstraints extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\RequiredConstraint[]|null
   */
  #[JsonProperty('any_of'), ArrayType([\ElevenLabs\Types\RequiredConstraint::class])]
  public ?array $anyOf;

  /**
   * @var \ElevenLabs\Types\RequiredConstraint[]|null
   */
  #[JsonProperty('all_of'), ArrayType([\ElevenLabs\Types\RequiredConstraint::class])]
  public ?array $allOf;

  /**
   * @param array{
   *   anyOf?: \ElevenLabs\Types\RequiredConstraint[]|null,
   *   allOf?: \ElevenLabs\Types\RequiredConstraint[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->anyOf = $values['anyOf'] ?? null;
    $this->allOf = $values['allOf'] ?? null;

    if (array_key_exists('anyOf', $values)) {
      $this->_dirtyFields['any_of'] = true;
    }
    if (array_key_exists('allOf', $values)) {
      $this->_dirtyFields['all_of'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->anyOf !== null) {
      $parts[] = [
        'name' => 'any_of',
        'contents' => json_encode($this->anyOf),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->allOf !== null) {
      $parts[] = [
        'name' => 'all_of',
        'contents' => json_encode($this->allOf),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->anyOf ?? [] as $item) {
      $item->validate();
    }
    foreach ($this->allOf ?? [] as $item) {
      $item->validate();
    }
  }
}

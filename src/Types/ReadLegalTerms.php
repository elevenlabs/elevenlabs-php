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
class ReadLegalTerms extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('terms')]
  public ?string $terms;

  #[JsonProperty('start_date')]
  public ?string $startDate;

  #[JsonProperty('end_date')]
  public ?string $endDate;

  /**
   * @param array{
   *   terms?: ?string,
   *   startDate?: ?string,
   *   endDate?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->terms = $values['terms'] ?? null;
    $this->startDate = $values['startDate'] ?? null;
    $this->endDate = $values['endDate'] ?? null;

    if (array_key_exists('terms', $values)) {
      $this->_dirtyFields['terms'] = true;
    }
    if (array_key_exists('startDate', $values)) {
      $this->_dirtyFields['start_date'] = true;
    }
    if (array_key_exists('endDate', $values)) {
      $this->_dirtyFields['end_date'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->terms !== null) {
      $parts[] = [
        'name' => 'terms',
        'contents' => $this->terms
      ];
    }

    if ($this->startDate !== null) {
      $parts[] = [
        'name' => 'start_date',
        'contents' => $this->startDate
      ];
    }

    if ($this->endDate !== null) {
      $parts[] = [
        'name' => 'end_date',
        'contents' => $this->endDate
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

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
class ListResponseMeta extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('total')]
  public ?int $total;

  #[JsonProperty('page')]
  public ?int $page;

  #[JsonProperty('page_size')]
  public ?int $pageSize;

  /**
   * @param array{
   *   total?: ?int,
   *   page?: ?int,
   *   pageSize?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->total = $values['total'] ?? null;
    $this->page = $values['page'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;

    if (array_key_exists('total', $values)) {
      $this->_dirtyFields['total'] = true;
    }
    if (array_key_exists('page', $values)) {
      $this->_dirtyFields['page'] = true;
    }
    if (array_key_exists('pageSize', $values)) {
      $this->_dirtyFields['page_size'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->total !== null) {
      $parts[] = [
        'name' => 'total',
        'contents' => (string) $this->total
      ];
    }

    if ($this->page !== null) {
      $parts[] = [
        'name' => 'page',
        'contents' => (string) $this->page
      ];
    }

    if ($this->pageSize !== null) {
      $parts[] = [
        'name' => 'page_size',
        'contents' => (string) $this->pageSize
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

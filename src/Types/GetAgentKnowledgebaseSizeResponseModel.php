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
class GetAgentKnowledgebaseSizeResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('number_of_pages', required: true)]
  public float $numberOfPages;

  /**
   * @param array{
   *   numberOfPages: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->numberOfPages = $values['numberOfPages'];

    $this->_dirtyFields = [
      'number_of_pages' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'number_of_pages',
      'contents' => (string) $this->numberOfPages
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

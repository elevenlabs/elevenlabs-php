<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The output of a prior generation on this API.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class GenerationReference extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\GenerationReferenceType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * The ID of the generation whose output to use, as returned when the generation was created.
   */
  #[JsonProperty('generation_id', required: true)]
  public string $generationId;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\GenerationReferenceType>,
   *   generationId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->generationId = $values['generationId'];

    $this->_dirtyFields = [
      'type' => true,
      'generation_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'generation_id',
      'contents' => $this->generationId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

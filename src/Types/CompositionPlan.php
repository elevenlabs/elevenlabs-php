<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;
use ElevenLabs\Utils\Validator;

/**
 * Composition plan for the `music_v2` and `music_v2_5` models. Using this field with any other model will result in an error.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CompositionPlan extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var (\ElevenLabs\Types\GenerationChunkInput|\ElevenLabs\Types\AudioRefChunk)[]
   * The chunks that make up the generation.
   */
  #[
    JsonProperty('chunks', required: true),
    ArrayType([
      new Union(
        \ElevenLabs\Types\GenerationChunkInput::class,
        \ElevenLabs\Types\AudioRefChunk::class
      )
    ])
  ]
  public array $chunks;

  /**
   * @param array{
   *   chunks: (\ElevenLabs\Types\GenerationChunkInput|\ElevenLabs\Types\AudioRefChunk)[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->chunks = $values['chunks'];

    $this->_dirtyFields = [
      'chunks' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'chunks',
      'contents' => json_encode($this->chunks),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->chunks, 'chunks', maxItems: 30);
  }
}

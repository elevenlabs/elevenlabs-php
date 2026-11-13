<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SimilarVoicesForSpeakerResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\SimilarVoice[]
   */
  #[JsonProperty('voices', required: true), ArrayType([\ElevenLabs\Types\SimilarVoice::class])]
  public array $voices;

  /**
   * @param array{
   *   voices: \ElevenLabs\Types\SimilarVoice[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->voices = $values['voices'];

    $this->_dirtyFields = [
      'voices' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'voices',
      'contents' => json_encode($this->voices),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->voices as $item) {
      $item->validate();
    }
  }
}

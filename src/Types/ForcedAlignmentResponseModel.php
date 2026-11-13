<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Model representing the response from the aligner service.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ForcedAlignmentResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\ForcedAlignmentCharacterResponseModel[]
   * List of characters with their timing information.
   */
  #[
    JsonProperty('characters', required: true),
    ArrayType([\ElevenLabs\Types\ForcedAlignmentCharacterResponseModel::class])
  ]
  public array $characters;

  /**
   * @var \ElevenLabs\Types\ForcedAlignmentWordResponseModel[]
   * List of words with their timing information.
   */
  #[
    JsonProperty('words', required: true),
    ArrayType([\ElevenLabs\Types\ForcedAlignmentWordResponseModel::class])
  ]
  public array $words;

  /**
   * The average alignment loss/confidence score for the entire transcript, calculated from all characters.
   */
  #[JsonProperty('loss', required: true)]
  public float $loss;

  /**
   * @param array{
   *   characters: \ElevenLabs\Types\ForcedAlignmentCharacterResponseModel[],
   *   words: \ElevenLabs\Types\ForcedAlignmentWordResponseModel[],
   *   loss: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->characters = $values['characters'];
    $this->words = $values['words'];
    $this->loss = $values['loss'];

    $this->_dirtyFields = [
      'characters' => true,
      'words' => true,
      'loss' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'characters',
      'contents' => json_encode($this->characters),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'words',
      'contents' => json_encode($this->words),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'loss',
      'contents' => (string) $this->loss
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->characters as $item) {
      $item->validate();
    }
    foreach ($this->words as $item) {
      $item->validate();
    }
  }
}

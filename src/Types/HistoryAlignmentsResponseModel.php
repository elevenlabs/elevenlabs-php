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
class HistoryAlignmentsResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('alignment', required: true)]
  public \ElevenLabs\Types\HistoryAlignmentResponseModel $alignment;

  #[JsonProperty('normalized_alignment', required: true)]
  public \ElevenLabs\Types\HistoryAlignmentResponseModel $normalizedAlignment;

  /**
   * @param array{
   *   alignment: \ElevenLabs\Types\HistoryAlignmentResponseModel,
   *   normalizedAlignment: \ElevenLabs\Types\HistoryAlignmentResponseModel,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->alignment = $values['alignment'];
    $this->normalizedAlignment = $values['normalizedAlignment'];

    $this->_dirtyFields = [
      'alignment' => true,
      'normalized_alignment' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'alignment',
      'contents' => json_encode($this->alignment),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'normalized_alignment',
      'contents' => json_encode($this->normalizedAlignment),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->alignment->validate();
    $this->normalizedAlignment->validate();
  }
}

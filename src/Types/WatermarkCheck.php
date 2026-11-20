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
class WatermarkCheck extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * True when an ElevenLabs watermark was found.
   */
  #[JsonProperty('is_detected', required: true)]
  public bool $isDetected;

  /**
   * Matched generation record. Null when none matched.
   */
  #[JsonProperty('details', required: true)]
  public ?\ElevenLabs\Types\WatermarkDetails $details;

  /**
   * @param array{
   *   isDetected: bool,
   *   details: ?\ElevenLabs\Types\WatermarkDetails,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->isDetected = $values['isDetected'];
    $this->details = $values['details'];

    $this->_dirtyFields = [
      'is_detected' => true,
      'details' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'is_detected',
      'contents' => $this->isDetected ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'details',
      'contents' => json_encode($this->details),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->details?->validate();
  }
}

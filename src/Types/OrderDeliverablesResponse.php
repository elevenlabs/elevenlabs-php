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
class OrderDeliverablesResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\DeliverableInfo[]
   * The list of delivered files for the order. Empty if the order is not yet completed.
   */
  #[
    JsonProperty('deliverables', required: true),
    ArrayType([\ElevenLabs\Types\DeliverableInfo::class])
  ]
  public array $deliverables;

  /**
   * @param array{
   *   deliverables: \ElevenLabs\Types\DeliverableInfo[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->deliverables = $values['deliverables'];

    $this->_dirtyFields = [
      'deliverables' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'deliverables',
      'contents' => json_encode($this->deliverables),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->deliverables as $item) {
      $item->validate();
    }
  }
}

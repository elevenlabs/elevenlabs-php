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
class OTelTracePayload extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\OTelResourceSpans[]
   */
  #[
    JsonProperty('resourceSpans', required: true),
    ArrayType([\ElevenLabs\Types\OTelResourceSpans::class])
  ]
  public array $resourceSpans;

  /**
   * @param array{
   *   resourceSpans: \ElevenLabs\Types\OTelResourceSpans[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->resourceSpans = $values['resourceSpans'];

    $this->_dirtyFields = [
      'resourceSpans' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'resourceSpans',
      'contents' => json_encode($this->resourceSpans),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->resourceSpans as $item) {
      $item->validate();
    }
  }
}

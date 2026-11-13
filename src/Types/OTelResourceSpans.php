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
class OTelResourceSpans extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('resource', required: true)]
  public \ElevenLabs\Types\OTelResource $resource;

  /**
   * @var \ElevenLabs\Types\OTelScopeSpans[]
   */
  #[
    JsonProperty('scopeSpans', required: true),
    ArrayType([\ElevenLabs\Types\OTelScopeSpans::class])
  ]
  public array $scopeSpans;

  /**
   * @param array{
   *   resource: \ElevenLabs\Types\OTelResource,
   *   scopeSpans: \ElevenLabs\Types\OTelScopeSpans[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->resource = $values['resource'];
    $this->scopeSpans = $values['scopeSpans'];

    $this->_dirtyFields = [
      'resource' => true,
      'scopeSpans' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'resource',
      'contents' => json_encode($this->resource),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'scopeSpans',
      'contents' => json_encode($this->scopeSpans),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->resource->validate();
    foreach ($this->scopeSpans as $item) {
      $item->validate();
    }
  }
}

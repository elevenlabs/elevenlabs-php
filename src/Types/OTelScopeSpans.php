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
class OTelScopeSpans extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('scope', required: true)]
  public \ElevenLabs\Types\OTelScope $scope;

  /**
   * @var \ElevenLabs\Types\OTelSpan[]
   */
  #[JsonProperty('spans', required: true), ArrayType([\ElevenLabs\Types\OTelSpan::class])]
  public array $spans;

  /**
   * @param array{
   *   scope: \ElevenLabs\Types\OTelScope,
   *   spans: \ElevenLabs\Types\OTelSpan[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->scope = $values['scope'];
    $this->spans = $values['spans'];

    $this->_dirtyFields = [
      'scope' => true,
      'spans' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'scope',
      'contents' => json_encode($this->scope),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'spans',
      'contents' => json_encode($this->spans),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->scope->validate();
    foreach ($this->spans as $item) {
      $item->validate();
    }
  }
}

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
class ConstantSchemaOverride extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ConstantSchemaOverrideSource>
   */
  #[JsonProperty('source')]
  public ?string $source;

  /**
   * The constant value to use
   */
  #[JsonProperty('constant_value', required: true)]
  public string|int|float|bool|array|null $constantValue;

  /**
   * @param array{
   *   constantValue: string|int|float|bool|array|null,
   *   source?: ?value-of<\ElevenLabs\Types\ConstantSchemaOverrideSource>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->source = $values['source'] ?? 'constant';
    $this->constantValue = $values['constantValue'];

    $this->_dirtyFields = [
      'constant_value' => true
    ];
    if (array_key_exists('source', $values)) {
      $this->_dirtyFields['source'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->source !== null) {
      $parts[] = [
        'name' => 'source',
        'contents' => $this->source
      ];
    }

    $parts[] = [
      'name' => 'constant_value',
      'contents' => json_encode($this->constantValue),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

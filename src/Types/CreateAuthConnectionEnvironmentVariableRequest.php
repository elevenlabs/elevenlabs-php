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
class CreateAuthConnectionEnvironmentVariableRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\CreateAuthConnectionEnvironmentVariableRequestType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * Unique label for the environment variable.
   */
  #[JsonProperty('label', required: true)]
  public string $label;

  /**
   * @var array<string, \ElevenLabs\Types\EnvironmentVariableAuthConnectionValueRequest>
   * Environment-specific auth connection references. Must include 'production' key.
   */
  #[
    JsonProperty('values', required: true),
    ArrayType(['string' => \ElevenLabs\Types\EnvironmentVariableAuthConnectionValueRequest::class])
  ]
  public array $values;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\CreateAuthConnectionEnvironmentVariableRequestType>,
   *   label: string,
   *   values: array<string, \ElevenLabs\Types\EnvironmentVariableAuthConnectionValueRequest>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->label = $values['label'];
    $this->values = $values['values'];

    $this->_dirtyFields = [
      'type' => true,
      'label' => true,
      'values' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'label',
      'contents' => $this->label
    ];

    $parts[] = [
      'name' => 'values',
      'contents' => json_encode($this->values),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

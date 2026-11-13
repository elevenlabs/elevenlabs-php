<?php

declare(strict_types=1);

namespace ElevenLabs\EnvironmentVariables\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class UpdateEnvironmentVariableRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, string|\ElevenLabs\Types\EnvironmentVariableSecretValueRequest|\ElevenLabs\Types\EnvironmentVariableAuthConnectionValueRequest>
   * Values to replace. Set to null to remove the value for an environment (except 'production').
   */
  #[
    JsonProperty('values', required: true),
    ArrayType([
      'string' => new Union(
        'string',
        \ElevenLabs\Types\EnvironmentVariableSecretValueRequest::class,
        \ElevenLabs\Types\EnvironmentVariableAuthConnectionValueRequest::class
      )
    ])
  ]
  public array $values;

  /**
   * @param array{
   *   values: array<string, string|\ElevenLabs\Types\EnvironmentVariableSecretValueRequest|\ElevenLabs\Types\EnvironmentVariableAuthConnectionValueRequest>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->values = $values['values'];

    $this->_dirtyFields = [
      'values' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
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

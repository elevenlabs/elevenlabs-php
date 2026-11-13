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
class EnvironmentVariableSecretValueRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('secret_id', required: true)]
  public string $secretId;

  /**
   * @param array{
   *   secretId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->secretId = $values['secretId'];

    $this->_dirtyFields = [
      'secret_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'secret_id',
      'contents' => $this->secretId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

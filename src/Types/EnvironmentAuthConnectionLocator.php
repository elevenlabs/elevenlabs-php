<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * References an environment variable of type 'auth_connection' by label.
 * At runtime, resolves to the auth connection for the current environment,
 * falling back to the default environment.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class EnvironmentAuthConnectionLocator extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('env_var_label', required: true)]
  public string $envVarLabel;

  /**
   * @param array{
   *   envVarLabel: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->envVarLabel = $values['envVarLabel'];

    $this->_dirtyFields = [
      'env_var_label' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'env_var_label',
      'contents' => $this->envVarLabel
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

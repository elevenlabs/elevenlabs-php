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
class ToolMockConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('default_return_value')]
  public ?string $defaultReturnValue;

  #[JsonProperty('default_is_error')]
  public ?bool $defaultIsError;

  /**
   * @param array{
   *   defaultReturnValue?: ?string,
   *   defaultIsError?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->defaultReturnValue = $values['defaultReturnValue'] ?? null;
    $this->defaultIsError = $values['defaultIsError'] ?? null;

    if (array_key_exists('defaultReturnValue', $values)) {
      $this->_dirtyFields['default_return_value'] = true;
    }
    if (array_key_exists('defaultIsError', $values)) {
      $this->_dirtyFields['default_is_error'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->defaultReturnValue !== null) {
      $parts[] = [
        'name' => 'default_return_value',
        'contents' => $this->defaultReturnValue
      ];
    }

    if ($this->defaultIsError !== null) {
      $parts[] = [
        'name' => 'default_is_error',
        'contents' => $this->defaultIsError ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

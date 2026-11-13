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
class StudioAgentToolSettingsModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('skip_confirmation')]
  public ?bool $skipConfirmation;

  /**
   * @param array{
   *   skipConfirmation?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->skipConfirmation = $values['skipConfirmation'] ?? null;

    if (array_key_exists('skipConfirmation', $values)) {
      $this->_dirtyFields['skip_confirmation'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->skipConfirmation !== null) {
      $parts[] = [
        'name' => 'skip_confirmation',
        'contents' => $this->skipConfirmation ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

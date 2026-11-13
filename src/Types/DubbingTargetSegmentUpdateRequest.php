<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A partial edit to a target segment. An omitted field is left unchanged; a provided `null`
 * clears it (see each field for what clearing means).
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DubbingTargetSegmentUpdateRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * New translated text, or null to mark the segment for re-translation.
   */
  #[JsonProperty('translation')]
  public ?string $translation;

  /**
   * @param array{
   *   translation?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->translation = $values['translation'] ?? null;

    if (array_key_exists('translation', $values)) {
      $this->_dirtyFields['translation'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->translation !== null) {
      $parts[] = [
        'name' => 'translation',
        'contents' => $this->translation
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

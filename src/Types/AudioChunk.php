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
class AudioChunk extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('audio')]
  public ?string $audio;

  #[JsonProperty('alignment')]
  public ?\ElevenLabs\Types\AudioChunkAlignment $alignment;

  #[JsonProperty('normalized_alignment')]
  public ?\ElevenLabs\Types\AudioChunkNormalizedAlignment $normalizedAlignment;

  /**
   * @param array{
   *   audio?: ?string,
   *   alignment?: ?\ElevenLabs\Types\AudioChunkAlignment,
   *   normalizedAlignment?: ?\ElevenLabs\Types\AudioChunkNormalizedAlignment,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->audio = $values['audio'] ?? null;
    $this->alignment = $values['alignment'] ?? null;
    $this->normalizedAlignment = $values['normalizedAlignment'] ?? null;

    if (array_key_exists('audio', $values)) {
      $this->_dirtyFields['audio'] = true;
    }
    if (array_key_exists('alignment', $values)) {
      $this->_dirtyFields['alignment'] = true;
    }
    if (array_key_exists('normalizedAlignment', $values)) {
      $this->_dirtyFields['normalized_alignment'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->audio !== null) {
      $parts[] = [
        'name' => 'audio',
        'contents' => $this->audio
      ];
    }

    if ($this->alignment !== null) {
      $parts[] = [
        'name' => 'alignment',
        'contents' => json_encode($this->alignment),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->normalizedAlignment !== null) {
      $parts[] = [
        'name' => 'normalized_alignment',
        'contents' => json_encode($this->normalizedAlignment),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->alignment?->validate();
    $this->normalizedAlignment?->validate();
  }
}

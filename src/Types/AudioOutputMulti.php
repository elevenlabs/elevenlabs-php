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
class AudioOutputMulti extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('audio', required: true)]
  public string $audio;

  #[JsonProperty('is_final')]
  public ?bool $isFinal;

  #[JsonProperty('normalized_alignment')]
  public ?\ElevenLabs\Types\AudioOutputMultiNormalizedAlignment $normalizedAlignment;

  #[JsonProperty('alignment')]
  public ?\ElevenLabs\Types\AudioOutputMultiAlignment $alignment;

  #[JsonProperty('context_id')]
  public ?string $contextId;

  /**
   * @param array{
   *   audio: string,
   *   isFinal?: ?bool,
   *   normalizedAlignment?: ?\ElevenLabs\Types\AudioOutputMultiNormalizedAlignment,
   *   alignment?: ?\ElevenLabs\Types\AudioOutputMultiAlignment,
   *   contextId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->audio = $values['audio'];
    $this->isFinal = $values['isFinal'] ?? null;
    $this->normalizedAlignment = $values['normalizedAlignment'] ?? null;
    $this->alignment = $values['alignment'] ?? null;
    $this->contextId = $values['contextId'] ?? null;

    $this->_dirtyFields = [
      'audio' => true
    ];
    if (array_key_exists('isFinal', $values)) {
      $this->_dirtyFields['is_final'] = true;
    }
    if (array_key_exists('normalizedAlignment', $values)) {
      $this->_dirtyFields['normalized_alignment'] = true;
    }
    if (array_key_exists('alignment', $values)) {
      $this->_dirtyFields['alignment'] = true;
    }
    if (array_key_exists('contextId', $values)) {
      $this->_dirtyFields['context_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'audio',
      'contents' => $this->audio
    ];

    if ($this->isFinal !== null) {
      $parts[] = [
        'name' => 'is_final',
        'contents' => $this->isFinal ? 'true' : 'false'
      ];
    }

    if ($this->normalizedAlignment !== null) {
      $parts[] = [
        'name' => 'normalized_alignment',
        'contents' => json_encode($this->normalizedAlignment),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->alignment !== null) {
      $parts[] = [
        'name' => 'alignment',
        'contents' => json_encode($this->alignment),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->contextId !== null) {
      $parts[] = [
        'name' => 'context_id',
        'contents' => $this->contextId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->normalizedAlignment?->validate();
    $this->alignment?->validate();
  }
}

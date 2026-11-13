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
class AudioWithTimestampsResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Base64 encoded audio data
   */
  #[JsonProperty('audio_base64', required: true)]
  public string $audioBase64;

  /**
   * Timestamp information for each character in the original text
   */
  #[JsonProperty('alignment')]
  public ?\ElevenLabs\Types\CharacterAlignmentResponseModel $alignment;

  /**
   * Timestamp information for each character in the normalized text
   */
  #[JsonProperty('normalized_alignment')]
  public ?\ElevenLabs\Types\CharacterAlignmentResponseModel $normalizedAlignment;

  /**
   * @param array{
   *   audioBase64: string,
   *   alignment?: ?\ElevenLabs\Types\CharacterAlignmentResponseModel,
   *   normalizedAlignment?: ?\ElevenLabs\Types\CharacterAlignmentResponseModel,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->audioBase64 = $values['audioBase64'];
    $this->alignment = $values['alignment'] ?? null;
    $this->normalizedAlignment = $values['normalizedAlignment'] ?? null;

    $this->_dirtyFields = [
      'audio_base64' => true
    ];
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
    $parts[] = [
      'name' => 'audio_base64',
      'contents' => $this->audioBase64
    ];

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

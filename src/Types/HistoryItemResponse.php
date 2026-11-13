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
class HistoryItemResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('state')]
  public mixed $state;

  #[JsonProperty('voice_category')]
  public mixed $voiceCategory;

  /**
   * @param array{
   *   state?: mixed,
   *   voiceCategory?: mixed,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->state = $values['state'] ?? null;
    $this->voiceCategory = $values['voiceCategory'] ?? null;

    if (array_key_exists('state', $values)) {
      $this->_dirtyFields['state'] = true;
    }
    if (array_key_exists('voiceCategory', $values)) {
      $this->_dirtyFields['voice_category'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->state !== null) {
      $parts[] = [
        'name' => 'state',
        'contents' => json_encode($this->state),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->voiceCategory !== null) {
      $parts[] = [
        'name' => 'voice_category',
        'contents' => json_encode($this->voiceCategory),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

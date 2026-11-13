<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BackgroundSoundConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\BackgroundSoundSourceType>
   * The type of background sound source.
   */
  #[JsonProperty('source_type')]
  public ?string $sourceType;

  /**
   * @var ?value-of<\ElevenLabs\Types\BackgroundSoundPresetId>
   * Identifier for the sound source.
   */
  #[JsonProperty('source_id')]
  public ?string $sourceId;

  /**
   * Volume level for background sound (0.01 to 1.0).
   */
  #[JsonProperty('volume')]
  public ?float $volume;

  /**
   * Apply a crossfade at the loop boundary to avoid audible pops when the sound loops.
   */
  #[JsonProperty('crossfade_loop')]
  public ?bool $crossfadeLoop;

  /**
   * @param array{
   *   sourceType?: ?value-of<\ElevenLabs\Types\BackgroundSoundSourceType>,
   *   sourceId?: ?value-of<\ElevenLabs\Types\BackgroundSoundPresetId>,
   *   volume?: ?float,
   *   crossfadeLoop?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->sourceType = $values['sourceType'] ?? 'preset';
    $this->sourceId = $values['sourceId'] ?? null;
    $this->volume = $values['volume'] ?? null;
    $this->crossfadeLoop = $values['crossfadeLoop'] ?? null;

    if (array_key_exists('sourceType', $values)) {
      $this->_dirtyFields['source_type'] = true;
    }
    if (array_key_exists('sourceId', $values)) {
      $this->_dirtyFields['source_id'] = true;
    }
    if (array_key_exists('volume', $values)) {
      $this->_dirtyFields['volume'] = true;
    }
    if (array_key_exists('crossfadeLoop', $values)) {
      $this->_dirtyFields['crossfade_loop'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->sourceType !== null) {
      $parts[] = [
        'name' => 'source_type',
        'contents' => $this->sourceType
      ];
    }

    if ($this->sourceId !== null) {
      $parts[] = [
        'name' => 'source_id',
        'contents' => $this->sourceId
      ];
    }

    if ($this->volume !== null) {
      $parts[] = [
        'name' => 'volume',
        'contents' => (string) $this->volume
      ];
    }

    if ($this->crossfadeLoop !== null) {
      $parts[] = [
        'name' => 'crossfade_loop',
        'contents' => $this->crossfadeLoop ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->volume, 'volume', min: 0.01, max: 1);
  }
}

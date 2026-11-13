<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Context for sound effect clips.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SfxSourceContext extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\SfxSourceContextSourceType>
   */
  #[JsonProperty('source_type')]
  public ?string $sourceType;

  #[JsonProperty('sound_generation_history_item_id')]
  public ?string $soundGenerationHistoryItemId;

  #[JsonProperty('text')]
  public ?string $text;

  /**
   * @var array<string, mixed>|null
   */
  #[JsonProperty('generation_config'), ArrayType(['string' => 'mixed'])]
  public ?array $generationConfig;

  /**
   * @param array{
   *   sourceType?: ?value-of<\ElevenLabs\Types\SfxSourceContextSourceType>,
   *   soundGenerationHistoryItemId?: ?string,
   *   text?: ?string,
   *   generationConfig?: array<string, mixed>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->sourceType = $values['sourceType'] ?? 'sfx';
    $this->soundGenerationHistoryItemId = $values['soundGenerationHistoryItemId'] ?? null;
    $this->text = $values['text'] ?? null;
    $this->generationConfig = $values['generationConfig'] ?? null;

    if (array_key_exists('sourceType', $values)) {
      $this->_dirtyFields['source_type'] = true;
    }
    if (array_key_exists('soundGenerationHistoryItemId', $values)) {
      $this->_dirtyFields['sound_generation_history_item_id'] = true;
    }
    if (array_key_exists('text', $values)) {
      $this->_dirtyFields['text'] = true;
    }
    if (array_key_exists('generationConfig', $values)) {
      $this->_dirtyFields['generation_config'] = true;
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

    if ($this->soundGenerationHistoryItemId !== null) {
      $parts[] = [
        'name' => 'sound_generation_history_item_id',
        'contents' => $this->soundGenerationHistoryItemId
      ];
    }

    if ($this->text !== null) {
      $parts[] = [
        'name' => 'text',
        'contents' => $this->text
      ];
    }

    if ($this->generationConfig !== null) {
      $parts[] = [
        'name' => 'generation_config',
        'contents' => json_encode($this->generationConfig),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

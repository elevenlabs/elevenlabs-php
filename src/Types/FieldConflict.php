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
class FieldConflict extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Identifier of the conflicting field relative to its section: a dot-path within conversation_config/platform_settings (e.g. `tts.voice_id`), a procedure id, or a workflow path: `nodes.<id>`, `edges.<id>`, or the name of a top-level workflow setting.
   */
  #[JsonProperty('path', required: true)]
  public string $path;

  /**
   * @var value-of<\ElevenLabs\Types\ConflictSection>
   */
  #[JsonProperty('section', required: true)]
  public string $section;

  #[JsonProperty('base_value')]
  public mixed $baseValue;

  #[JsonProperty('source_value')]
  public mixed $sourceValue;

  #[JsonProperty('target_value')]
  public mixed $targetValue;

  /**
   * Stable identifier of this conflict within a merge.
   */
  #[JsonProperty('id')]
  public ?string $id;

  /**
   * Whether a resolution of this conflict may use `custom` with a `custom_value` instead of keeping a side.
   */
  #[JsonProperty('accepts_custom_value')]
  public ?bool $acceptsCustomValue;

  /**
   * @param array{
   *   path: string,
   *   section: value-of<\ElevenLabs\Types\ConflictSection>,
   *   baseValue?: mixed,
   *   sourceValue?: mixed,
   *   targetValue?: mixed,
   *   id?: ?string,
   *   acceptsCustomValue?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->path = $values['path'];
    $this->section = $values['section'];
    $this->baseValue = $values['baseValue'] ?? null;
    $this->sourceValue = $values['sourceValue'] ?? null;
    $this->targetValue = $values['targetValue'] ?? null;
    $this->id = $values['id'] ?? null;
    $this->acceptsCustomValue = $values['acceptsCustomValue'] ?? null;

    $this->_dirtyFields = [
      'path' => true,
      'section' => true
    ];
    if (array_key_exists('baseValue', $values)) {
      $this->_dirtyFields['base_value'] = true;
    }
    if (array_key_exists('sourceValue', $values)) {
      $this->_dirtyFields['source_value'] = true;
    }
    if (array_key_exists('targetValue', $values)) {
      $this->_dirtyFields['target_value'] = true;
    }
    if (array_key_exists('id', $values)) {
      $this->_dirtyFields['id'] = true;
    }
    if (array_key_exists('acceptsCustomValue', $values)) {
      $this->_dirtyFields['accepts_custom_value'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'path',
      'contents' => $this->path
    ];

    $parts[] = [
      'name' => 'section',
      'contents' => $this->section
    ];

    if ($this->baseValue !== null) {
      $parts[] = [
        'name' => 'base_value',
        'contents' => json_encode($this->baseValue),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->sourceValue !== null) {
      $parts[] = [
        'name' => 'source_value',
        'contents' => json_encode($this->sourceValue),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->targetValue !== null) {
      $parts[] = [
        'name' => 'target_value',
        'contents' => json_encode($this->targetValue),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->id !== null) {
      $parts[] = [
        'name' => 'id',
        'contents' => $this->id
      ];
    }

    if ($this->acceptsCustomValue !== null) {
      $parts[] = [
        'name' => 'accepts_custom_value',
        'contents' => $this->acceptsCustomValue ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

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
class ConversationConfigOverrideConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether to allow overriding the text_only field.
   */
  #[JsonProperty('text_only')]
  public ?bool $textOnly;

  /**
   * Whether to allow overriding the max_duration_seconds field.
   */
  #[JsonProperty('max_duration_seconds')]
  public ?bool $maxDurationSeconds;

  /**
   * @param array{
   *   textOnly?: ?bool,
   *   maxDurationSeconds?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->textOnly = $values['textOnly'] ?? null;
    $this->maxDurationSeconds = $values['maxDurationSeconds'] ?? null;

    if (array_key_exists('textOnly', $values)) {
      $this->_dirtyFields['text_only'] = true;
    }
    if (array_key_exists('maxDurationSeconds', $values)) {
      $this->_dirtyFields['max_duration_seconds'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->textOnly !== null) {
      $parts[] = [
        'name' => 'text_only',
        'contents' => $this->textOnly ? 'true' : 'false'
      ];
    }

    if ($this->maxDurationSeconds !== null) {
      $parts[] = [
        'name' => 'max_duration_seconds',
        'contents' => $this->maxDurationSeconds ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

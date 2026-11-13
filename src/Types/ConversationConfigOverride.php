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
class ConversationConfigOverride extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * If enabled audio will not be processed and only text will be used, use to avoid audio pricing.
   */
  #[JsonProperty('text_only')]
  public ?bool $textOnly;

  /**
   * The maximum duration of a conversation in seconds
   */
  #[JsonProperty('max_duration_seconds')]
  public ?int $maxDurationSeconds;

  /**
   * @param array{
   *   textOnly?: ?bool,
   *   maxDurationSeconds?: ?int,
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
        'contents' => (string) $this->maxDurationSeconds
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

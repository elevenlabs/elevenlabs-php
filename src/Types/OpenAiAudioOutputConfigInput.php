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
class OpenAiAudioOutputConfigInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('format')]
  public ?\ElevenLabs\Types\OpenAiAudioOutputFormat $format;

  #[JsonProperty('voice')]
  public ?string $voice;

  /**
   * @param array{
   *   format?: ?\ElevenLabs\Types\OpenAiAudioOutputFormat,
   *   voice?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->format = $values['format'] ?? null;
    $this->voice = $values['voice'] ?? null;

    if (array_key_exists('format', $values)) {
      $this->_dirtyFields['format'] = true;
    }
    if (array_key_exists('voice', $values)) {
      $this->_dirtyFields['voice'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->format !== null) {
      $parts[] = [
        'name' => 'format',
        'contents' => json_encode($this->format),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->voice !== null) {
      $parts[] = [
        'name' => 'voice',
        'contents' => $this->voice
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->format?->validate();
  }
}

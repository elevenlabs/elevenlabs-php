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
class OpenAiAudioInputTranscription extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Language code of the conversation (e.g. en, es, pt-br), used for transcription, speech and the model's reply language. Defaults to en.
   */
  #[JsonProperty('language')]
  public ?string $language;

  /**
   * @param array{
   *   language?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->language = $values['language'] ?? null;

    if (array_key_exists('language', $values)) {
      $this->_dirtyFields['language'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->language !== null) {
      $parts[] = [
        'name' => 'language',
        'contents' => $this->language
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

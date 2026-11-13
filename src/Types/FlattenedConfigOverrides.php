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
class FlattenedConfigOverrides extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('language')]
  public ?string $language;

  #[JsonProperty('first_message')]
  public ?string $firstMessage;

  #[JsonProperty('prompt')]
  public ?string $prompt;

  #[JsonProperty('voice_id')]
  public ?string $voiceId;

  /**
   * @param array{
   *   language?: ?string,
   *   firstMessage?: ?string,
   *   prompt?: ?string,
   *   voiceId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->language = $values['language'] ?? null;
    $this->firstMessage = $values['firstMessage'] ?? null;
    $this->prompt = $values['prompt'] ?? null;
    $this->voiceId = $values['voiceId'] ?? null;

    if (array_key_exists('language', $values)) {
      $this->_dirtyFields['language'] = true;
    }
    if (array_key_exists('firstMessage', $values)) {
      $this->_dirtyFields['first_message'] = true;
    }
    if (array_key_exists('prompt', $values)) {
      $this->_dirtyFields['prompt'] = true;
    }
    if (array_key_exists('voiceId', $values)) {
      $this->_dirtyFields['voice_id'] = true;
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

    if ($this->firstMessage !== null) {
      $parts[] = [
        'name' => 'first_message',
        'contents' => $this->firstMessage
      ];
    }

    if ($this->prompt !== null) {
      $parts[] = [
        'name' => 'prompt',
        'contents' => $this->prompt
      ];
    }

    if ($this->voiceId !== null) {
      $parts[] = [
        'name' => 'voice_id',
        'contents' => $this->voiceId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

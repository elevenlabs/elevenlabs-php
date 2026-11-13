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
class SpeechEngineConversationInitiationClientDataConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether the first message can be overridden by the client
   */
  #[JsonProperty('first_message')]
  public ?bool $firstMessage;

  /**
   * @param array{
   *   firstMessage?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->firstMessage = $values['firstMessage'] ?? null;

    if (array_key_exists('firstMessage', $values)) {
      $this->_dirtyFields['first_message'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->firstMessage !== null) {
      $parts[] = [
        'name' => 'first_message',
        'contents' => $this->firstMessage ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

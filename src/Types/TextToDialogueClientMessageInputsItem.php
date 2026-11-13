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
class TextToDialogueClientMessageInputsItem extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Text to convert to speech.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * Voice ID for this segment.
   */
  #[JsonProperty('voice_id', required: true)]
  public string $voiceId;

  /**
   * Signal that this input starts a new speaker turn for prosody continuity.
   */
  #[JsonProperty('new_turn')]
  public ?bool $newTurn;

  /**
   * @param array{
   *   text: string,
   *   voiceId: string,
   *   newTurn?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->text = $values['text'];
    $this->voiceId = $values['voiceId'];
    $this->newTurn = $values['newTurn'] ?? null;

    $this->_dirtyFields = [
      'text' => true,
      'voice_id' => true
    ];
    if (array_key_exists('newTurn', $values)) {
      $this->_dirtyFields['new_turn'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    $parts[] = [
      'name' => 'voice_id',
      'contents' => $this->voiceId
    ];

    if ($this->newTurn !== null) {
      $parts[] = [
        'name' => 'new_turn',
        'contents' => $this->newTurn ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

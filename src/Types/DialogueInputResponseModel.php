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
class DialogueInputResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The text of the dialogue input line.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * The ID of the voice used for this dialogue input line.
   */
  #[JsonProperty('voice_id', required: true)]
  public string $voiceId;

  /**
   * The name of the voice used for this dialogue input line.
   */
  #[JsonProperty('voice_name', required: true)]
  public string $voiceName;

  /**
   * @param array{
   *   text: string,
   *   voiceId: string,
   *   voiceName: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->text = $values['text'];
    $this->voiceId = $values['voiceId'];
    $this->voiceName = $values['voiceName'];

    $this->_dirtyFields = [
      'text' => true,
      'voice_id' => true,
      'voice_name' => true
    ];
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

    $parts[] = [
      'name' => 'voice_name',
      'contents' => $this->voiceName
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

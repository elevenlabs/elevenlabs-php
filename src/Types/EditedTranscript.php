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
class EditedTranscript extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('message_type')]
  public ?string $messageType;

  /**
   * The committed transcript text the edit instruction was applied to.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * The edited transcript text. If no edits were made it will be identical to the `text` field.
   */
  #[JsonProperty('edited_text', required: true)]
  public string $editedText;

  /**
   * @param array{
   *   text: string,
   *   editedText: string,
   *   messageType?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->messageType = $values['messageType'] ?? null;
    $this->text = $values['text'];
    $this->editedText = $values['editedText'];

    $this->_dirtyFields = [
      'text' => true,
      'edited_text' => true
    ];
    if (array_key_exists('messageType', $values)) {
      $this->_dirtyFields['message_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->messageType !== null) {
      $parts[] = [
        'name' => 'message_type',
        'contents' => $this->messageType
      ];
    }

    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    $parts[] = [
      'name' => 'edited_text',
      'contents' => $this->editedText
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

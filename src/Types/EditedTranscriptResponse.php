<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A transcript produced by the optional transcript edit (text only, untimed).
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class EditedTranscriptResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\EditedTranscriptResponseKind>
   */
  #[JsonProperty('kind', required: true)]
  public string $kind;

  /**
   * The edited transcript text.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * The edited transcript text. Same value as `text`; matches the `edited_text` field of the realtime `edited_transcript` event.
   */
  #[JsonProperty('edited_text')]
  public ?string $editedText;

  /**
   * @param array{
   *   kind: value-of<\ElevenLabs\Types\EditedTranscriptResponseKind>,
   *   text: string,
   *   editedText?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->kind = $values['kind'];
    $this->text = $values['text'];
    $this->editedText = $values['editedText'] ?? null;

    $this->_dirtyFields = [
      'kind' => true,
      'text' => true
    ];
    if (array_key_exists('editedText', $values)) {
      $this->_dirtyFields['edited_text'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'kind',
      'contents' => $this->kind
    ];

    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    if ($this->editedText !== null) {
      $parts[] = [
        'name' => 'edited_text',
        'contents' => $this->editedText
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

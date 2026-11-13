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
class ChapterContentParagraphTtsNodeInputModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\ChapterContentParagraphTtsNodeInputModelType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('text', required: true)]
  public string $text;

  #[JsonProperty('voice_id', required: true)]
  public string $voiceId;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\ChapterContentParagraphTtsNodeInputModelType>,
   *   text: string,
   *   voiceId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->text = $values['text'];
    $this->voiceId = $values['voiceId'];

    $this->_dirtyFields = [
      'type' => true,
      'text' => true,
      'voice_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    $parts[] = [
      'name' => 'voice_id',
      'contents' => $this->voiceId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

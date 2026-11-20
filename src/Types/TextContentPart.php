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
class TextContentPart extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\TextContentPartType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\TextContentPartType>,
   *   text: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->text = $values['text'];

    $this->_dirtyFields = [
      'type' => true,
      'text' => true
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

    return $parts;
  }

  public function validate(): void
  {
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SuggestedAudioTag extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Audio tag to use (for best performance, 1-2 words, e.g., 'happy', 'excited')
   */
  #[JsonProperty('tag', required: true)]
  public string $tag;

  /**
   * Optional description of when to use this tag
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @param array{
   *   tag: string,
   *   description?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->tag = $values['tag'];
    $this->description = $values['description'] ?? null;

    $this->_dirtyFields = [
      'tag' => true
    ];
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'tag',
      'contents' => $this->tag
    ];

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->tag, 'tag', minLength: 1, maxLength: 30);
    Validator::validateString($this->description, 'description', maxLength: 200);
  }
}

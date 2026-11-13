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
class CommittedTranscriptEntitiesEntitiesItem extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The text that was identified as an entity.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * The type of entity detected (e.g., 'credit_card', 'email_address', 'person_name').
   */
  #[JsonProperty('entity_type', required: true)]
  public string $entityType;

  /**
   * Start character position in the transcript text.
   */
  #[JsonProperty('start_char', required: true)]
  public int $startChar;

  /**
   * End character position in the transcript text.
   */
  #[JsonProperty('end_char', required: true)]
  public int $endChar;

  /**
   * @param array{
   *   text: string,
   *   entityType: string,
   *   startChar: int,
   *   endChar: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->text = $values['text'];
    $this->entityType = $values['entityType'];
    $this->startChar = $values['startChar'];
    $this->endChar = $values['endChar'];

    $this->_dirtyFields = [
      'text' => true,
      'entity_type' => true,
      'start_char' => true,
      'end_char' => true
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
      'name' => 'entity_type',
      'contents' => $this->entityType
    ];

    $parts[] = [
      'name' => 'start_char',
      'contents' => (string) $this->startChar
    ];

    $parts[] = [
      'name' => 'end_char',
      'contents' => (string) $this->endChar
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

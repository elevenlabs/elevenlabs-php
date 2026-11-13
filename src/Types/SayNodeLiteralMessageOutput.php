<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SayNodeLiteralMessageOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\SayNodeLiteralMessageOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * Exact text spoken by the agent. Supports `{{variable_name}}` dynamic variable placeholders.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * @var array<string, \ElevenLabs\Types\TranslatedString>
   * Translations of `text`, keyed by language code. When the conversation language has an entry, its value is spoken instead of `text`.
   */
  #[
    JsonProperty('text_translations', required: true),
    ArrayType(['string' => \ElevenLabs\Types\TranslatedString::class])
  ]
  public array $textTranslations;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\SayNodeLiteralMessageOutputType>,
   *   text: string,
   *   textTranslations: array<string, \ElevenLabs\Types\TranslatedString>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->text = $values['text'];
    $this->textTranslations = $values['textTranslations'];

    $this->_dirtyFields = [
      'type' => true,
      'text' => true,
      'text_translations' => true
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
      'name' => 'text_translations',
      'contents' => json_encode($this->textTranslations),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->text, 'text', minLength: 1);
  }
}

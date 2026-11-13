<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WidgetTextContentsTranslation extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, string>|null
   * The source text each translated field was derived from
   */
  #[JsonProperty('source'), ArrayType(['string' => 'string'])]
  public ?array $source;

  /**
   * @var array<string, string>|null
   * The last auto-translated output for each translated field
   */
  #[JsonProperty('text'), ArrayType(['string' => 'string'])]
  public ?array $text;

  /**
   * @param array{
   *   source?: array<string, string>|null,
   *   text?: array<string, string>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->source = $values['source'] ?? null;
    $this->text = $values['text'] ?? null;

    if (array_key_exists('source', $values)) {
      $this->_dirtyFields['source'] = true;
    }
    if (array_key_exists('text', $values)) {
      $this->_dirtyFields['text'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->source !== null) {
      $parts[] = [
        'name' => 'source',
        'contents' => json_encode($this->source),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->text !== null) {
      $parts[] = [
        'name' => 'text',
        'contents' => json_encode($this->text),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

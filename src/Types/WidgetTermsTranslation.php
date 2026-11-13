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
class WidgetTermsTranslation extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('source_hash', required: true)]
  public string $sourceHash;

  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * @param array{
   *   sourceHash: string,
   *   text: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->sourceHash = $values['sourceHash'];
    $this->text = $values['text'];

    $this->_dirtyFields = [
      'source_hash' => true,
      'text' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'source_hash',
      'contents' => $this->sourceHash
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

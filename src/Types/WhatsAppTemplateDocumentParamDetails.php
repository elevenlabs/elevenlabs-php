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
class WhatsAppTemplateDocumentParamDetails extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('link', required: true)]
  public string $link;

  #[JsonProperty('filename')]
  public ?string $filename;

  /**
   * @param array{
   *   link: string,
   *   filename?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->link = $values['link'];
    $this->filename = $values['filename'] ?? null;

    $this->_dirtyFields = [
      'link' => true
    ];
    if (array_key_exists('filename', $values)) {
      $this->_dirtyFields['filename'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'link',
      'contents' => $this->link
    ];

    if ($this->filename !== null) {
      $parts[] = [
        'name' => 'filename',
        'contents' => $this->filename
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

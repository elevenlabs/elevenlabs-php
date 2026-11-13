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
class WhatsAppTemplateComponentButton extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('text')]
  public ?string $text;

  #[JsonProperty('url')]
  public ?string $url;

  /**
   * @param array{
   *   type: string,
   *   text?: ?string,
   *   url?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->text = $values['text'] ?? null;
    $this->url = $values['url'] ?? null;

    $this->_dirtyFields = [
      'type' => true
    ];
    if (array_key_exists('text', $values)) {
      $this->_dirtyFields['text'] = true;
    }
    if (array_key_exists('url', $values)) {
      $this->_dirtyFields['url'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    if ($this->text !== null) {
      $parts[] = [
        'name' => 'text',
        'contents' => $this->text
      ];
    }

    if ($this->url !== null) {
      $parts[] = [
        'name' => 'url',
        'contents' => $this->url
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

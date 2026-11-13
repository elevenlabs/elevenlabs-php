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
class WhatsAppTemplateComponent extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('format')]
  public ?string $format;

  #[JsonProperty('text')]
  public ?string $text;

  /**
   * @var \ElevenLabs\Types\WhatsAppTemplateComponentButton[]|null
   */
  #[JsonProperty('buttons'), ArrayType([\ElevenLabs\Types\WhatsAppTemplateComponentButton::class])]
  public ?array $buttons;

  /**
   * @param array{
   *   type: string,
   *   format?: ?string,
   *   text?: ?string,
   *   buttons?: \ElevenLabs\Types\WhatsAppTemplateComponentButton[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->format = $values['format'] ?? null;
    $this->text = $values['text'] ?? null;
    $this->buttons = $values['buttons'] ?? null;

    $this->_dirtyFields = [
      'type' => true
    ];
    if (array_key_exists('format', $values)) {
      $this->_dirtyFields['format'] = true;
    }
    if (array_key_exists('text', $values)) {
      $this->_dirtyFields['text'] = true;
    }
    if (array_key_exists('buttons', $values)) {
      $this->_dirtyFields['buttons'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    if ($this->format !== null) {
      $parts[] = [
        'name' => 'format',
        'contents' => $this->format
      ];
    }

    if ($this->text !== null) {
      $parts[] = [
        'name' => 'text',
        'contents' => $this->text
      ];
    }

    if ($this->buttons !== null) {
      $parts[] = [
        'name' => 'buttons',
        'contents' => json_encode($this->buttons),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->buttons ?? [] as $item) {
      $item->validate();
    }
  }
}

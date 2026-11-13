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
class WhatsAppTemplateImageParam extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\WhatsAppTemplateImageParamType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('image', required: true)]
  public \ElevenLabs\Types\WhatsAppTemplateImageParamDetails $image;

  /**
   * @param array{
   *   image: \ElevenLabs\Types\WhatsAppTemplateImageParamDetails,
   *   type?: ?value-of<\ElevenLabs\Types\WhatsAppTemplateImageParamType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'image';
    $this->image = $values['image'];

    $this->_dirtyFields = [
      'image' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'image',
      'contents' => json_encode($this->image),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->image->validate();
  }
}

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
class WhatsAppTemplateLocationParam extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\WhatsAppTemplateLocationParamType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('location', required: true)]
  public \ElevenLabs\Types\WhatsAppTemplateLocationParamDetails $location;

  /**
   * @param array{
   *   location: \ElevenLabs\Types\WhatsAppTemplateLocationParamDetails,
   *   type?: ?value-of<\ElevenLabs\Types\WhatsAppTemplateLocationParamType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'location';
    $this->location = $values['location'];

    $this->_dirtyFields = [
      'location' => true
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
      'name' => 'location',
      'contents' => json_encode($this->location),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->location->validate();
  }
}

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
class WhatsAppTemplateBodyComponentParams extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\WhatsAppTemplateBodyComponentParamsType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @var \ElevenLabs\Types\WhatsAppTemplateTextParam[]
   */
  #[
    JsonProperty('parameters', required: true),
    ArrayType([\ElevenLabs\Types\WhatsAppTemplateTextParam::class])
  ]
  public array $parameters;

  /**
   * @param array{
   *   parameters: \ElevenLabs\Types\WhatsAppTemplateTextParam[],
   *   type?: ?value-of<\ElevenLabs\Types\WhatsAppTemplateBodyComponentParamsType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'body';
    $this->parameters = $values['parameters'];

    $this->_dirtyFields = [
      'parameters' => true
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
      'name' => 'parameters',
      'contents' => json_encode($this->parameters),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->parameters as $item) {
      $item->validate();
    }
  }
}

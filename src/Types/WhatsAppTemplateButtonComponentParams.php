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
class WhatsAppTemplateButtonComponentParams extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\WhatsAppTemplateButtonComponentParamsType>
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

  #[JsonProperty('index', required: true)]
  public int $index;

  #[JsonProperty('sub_type', required: true)]
  public string $subType;

  /**
   * @param array{
   *   parameters: \ElevenLabs\Types\WhatsAppTemplateTextParam[],
   *   index: int,
   *   subType: string,
   *   type?: ?value-of<\ElevenLabs\Types\WhatsAppTemplateButtonComponentParamsType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'button';
    $this->parameters = $values['parameters'];
    $this->index = $values['index'];
    $this->subType = $values['subType'];

    $this->_dirtyFields = [
      'parameters' => true,
      'index' => true,
      'sub_type' => true
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

    $parts[] = [
      'name' => 'index',
      'contents' => (string) $this->index
    ];

    $parts[] = [
      'name' => 'sub_type',
      'contents' => $this->subType
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

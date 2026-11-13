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
class WhatsAppTemplate extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * https://developers.facebook.com/documentation/business-messaging/whatsapp/templates/supported-languages
   */
  #[JsonProperty('language', required: true)]
  public string $language;

  /**
   * @var ?value-of<\ElevenLabs\Types\WhatsAppTemplateParameterFormat>
   */
  #[JsonProperty('parameter_format')]
  public ?string $parameterFormat;

  /**
   * @var \ElevenLabs\Types\WhatsAppTemplateComponent[]
   */
  #[
    JsonProperty('components', required: true),
    ArrayType([\ElevenLabs\Types\WhatsAppTemplateComponent::class])
  ]
  public array $components;

  /**
   * https://developers.facebook.com/docs/graph-api/reference/whats-app-business-account/message_templates/
   */
  #[JsonProperty('category')]
  public ?string $category;

  /**
   * @param array{
   *   name: string,
   *   language: string,
   *   components: \ElevenLabs\Types\WhatsAppTemplateComponent[],
   *   parameterFormat?: ?value-of<\ElevenLabs\Types\WhatsAppTemplateParameterFormat>,
   *   category?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->language = $values['language'];
    $this->parameterFormat = $values['parameterFormat'] ?? null;
    $this->components = $values['components'];
    $this->category = $values['category'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'language' => true,
      'components' => true
    ];
    if (array_key_exists('parameterFormat', $values)) {
      $this->_dirtyFields['parameter_format'] = true;
    }
    if (array_key_exists('category', $values)) {
      $this->_dirtyFields['category'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'language',
      'contents' => $this->language
    ];

    if ($this->parameterFormat !== null) {
      $parts[] = [
        'name' => 'parameter_format',
        'contents' => $this->parameterFormat
      ];
    }

    $parts[] = [
      'name' => 'components',
      'contents' => json_encode($this->components),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->category !== null) {
      $parts[] = [
        'name' => 'category',
        'contents' => $this->category
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->components as $item) {
      $item->validate();
    }
  }
}

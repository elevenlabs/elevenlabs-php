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
class WhatsAppTemplateTextParam extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('parameter_name')]
  public ?string $parameterName;

  /**
   * @var ?value-of<\ElevenLabs\Types\WhatsAppTemplateTextParamType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * @param array{
   *   text: string,
   *   parameterName?: ?string,
   *   type?: ?value-of<\ElevenLabs\Types\WhatsAppTemplateTextParamType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->parameterName = $values['parameterName'] ?? null;
    $this->type = $values['type'] ?? 'text';
    $this->text = $values['text'];

    $this->_dirtyFields = [
      'text' => true
    ];
    if (array_key_exists('parameterName', $values)) {
      $this->_dirtyFields['parameter_name'] = true;
    }
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->parameterName !== null) {
      $parts[] = [
        'name' => 'parameter_name',
        'contents' => $this->parameterName
      ];
    }

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

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

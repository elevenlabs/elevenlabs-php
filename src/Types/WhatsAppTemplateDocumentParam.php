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
class WhatsAppTemplateDocumentParam extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\WhatsAppTemplateDocumentParamType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('document', required: true)]
  public \ElevenLabs\Types\WhatsAppTemplateDocumentParamDetails $document;

  /**
   * @param array{
   *   document: \ElevenLabs\Types\WhatsAppTemplateDocumentParamDetails,
   *   type?: ?value-of<\ElevenLabs\Types\WhatsAppTemplateDocumentParamType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'document';
    $this->document = $values['document'];

    $this->_dirtyFields = [
      'document' => true
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
      'name' => 'document',
      'contents' => json_encode($this->document),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->document->validate();
  }
}

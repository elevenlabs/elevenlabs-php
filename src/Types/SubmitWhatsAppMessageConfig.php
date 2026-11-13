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
class SubmitWhatsAppMessageConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\SubmitWhatsAppMessageConfigMode>
   */
  #[JsonProperty('mode')]
  public ?string $mode;

  /**
   * Names the approved Meta template to send. The server loads the template
   * itself, so the client never supplies its components.
   */
  #[JsonProperty('template', required: true)]
  public \ElevenLabs\Types\SubmitWhatsAppTemplateRef $template;

  /**
   * @param array{
   *   template: \ElevenLabs\Types\SubmitWhatsAppTemplateRef,
   *   mode?: ?value-of<\ElevenLabs\Types\SubmitWhatsAppMessageConfigMode>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->mode = $values['mode'] ?? 'message';
    $this->template = $values['template'];

    $this->_dirtyFields = [
      'template' => true
    ];
    if (array_key_exists('mode', $values)) {
      $this->_dirtyFields['mode'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->mode !== null) {
      $parts[] = [
        'name' => 'mode',
        'contents' => $this->mode
      ];
    }

    $parts[] = [
      'name' => 'template',
      'contents' => json_encode($this->template),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->template->validate();
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * Names the approved Meta template to send. The server loads the template
 * itself, so the client never supplies its components.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SubmitWhatsAppTemplateRef extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The template's language code, such as `en_US`.
   */
  #[JsonProperty('language', required: true)]
  public string $language;

  /**
   * @param array{
   *   name: string,
   *   language: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->language = $values['language'];

    $this->_dirtyFields = [
      'name' => true,
      'language' => true
    ];
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

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->name, 'name', minLength: 1, maxLength: 512);
    Validator::validateString($this->language, 'language', minLength: 1, maxLength: 64);
  }
}

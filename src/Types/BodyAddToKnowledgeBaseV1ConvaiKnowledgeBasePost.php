<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyAddToKnowledgeBaseV1ConvaiKnowledgeBasePost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * A custom, human-readable name for the document.
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * URL to a page of documentation that the agent will have access to in order to interact with users.
   */
  #[JsonProperty('url')]
  public ?string $url;

  /**
   * @var ?string
   * Documentation that the agent will have access to in order to interact with users.
   */
  #[JsonProperty('file')]
  public ?string $file;

  /**
   * @param array{
   *   name?: ?string,
   *   url?: ?string,
   *   file?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->name = $values['name'] ?? null;
    $this->url = $values['url'] ?? null;
    $this->file = $values['file'] ?? null;

    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('url', $values)) {
      $this->_dirtyFields['url'] = true;
    }
    if (array_key_exists('file', $values)) {
      $this->_dirtyFields['file'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->url !== null) {
      $parts[] = [
        'name' => 'url',
        'contents' => $this->url
      ];
    }

    if ($this->file !== null) {
      $parts[] = [
        'name' => 'file',
        'contents' => $this->file
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->name, 'name', minLength: 1);
  }
}

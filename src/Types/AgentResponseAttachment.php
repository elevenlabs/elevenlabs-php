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
class AgentResponseAttachment extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('url', required: true)]
  public string $url;

  #[JsonProperty('name', required: true)]
  public string $name;

  #[JsonProperty('mime_type')]
  public ?string $mimeType;

  /**
   * @param array{
   *   url: string,
   *   name: string,
   *   mimeType?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->url = $values['url'];
    $this->name = $values['name'];
    $this->mimeType = $values['mimeType'] ?? null;

    $this->_dirtyFields = [
      'url' => true,
      'name' => true
    ];
    if (array_key_exists('mimeType', $values)) {
      $this->_dirtyFields['mime_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'url',
      'contents' => $this->url
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->mimeType !== null) {
      $parts[] = [
        'name' => 'mime_type',
        'contents' => $this->mimeType
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

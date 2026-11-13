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
class PodcastUrlSource extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\PodcastUrlSourceType>
   * The type of source to create.
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * The URL to create the podcast from.
   */
  #[JsonProperty('url', required: true)]
  public string $url;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\PodcastUrlSourceType>,
   *   url: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->url = $values['url'];

    $this->_dirtyFields = [
      'type' => true,
      'url' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'url',
      'contents' => $this->url
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\AudioNative\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyUpdateAudioNativeContentFromUrlV1AudioNativeContentPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * URL of the page to extract content from.
   */
  #[JsonProperty('url', required: true)]
  public string $url;

  /**
   * Author used in the player and inserted at the start of the uploaded article. If not provided, the default author set in the Player settings is used.
   */
  #[JsonProperty('author')]
  public ?string $author;

  /**
   * Title used in the player and inserted at the top of the uploaded article. If not provided, the default title set in the Player settings is used.
   */
  #[JsonProperty('title')]
  public ?string $title;

  /**
   * @param array{
   *   url: string,
   *   author?: ?string,
   *   title?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->url = $values['url'];
    $this->author = $values['author'] ?? null;
    $this->title = $values['title'] ?? null;

    $this->_dirtyFields = [
      'url' => true
    ];
    if (array_key_exists('author', $values)) {
      $this->_dirtyFields['author'] = true;
    }
    if (array_key_exists('title', $values)) {
      $this->_dirtyFields['title'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'url',
      'contents' => $this->url
    ];

    if ($this->author !== null) {
      $parts[] = [
        'name' => 'author',
        'contents' => $this->author
      ];
    }

    if ($this->title !== null) {
      $parts[] = [
        'name' => 'title',
        'contents' => $this->title
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

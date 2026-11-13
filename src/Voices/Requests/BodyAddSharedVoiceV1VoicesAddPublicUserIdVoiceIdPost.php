<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyAddSharedVoiceV1VoicesAddPublicUserIdVoiceIdPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The name that identifies this voice. This will be displayed in the dropdown of the website.
   */
  #[JsonProperty('new_name', required: true)]
  public string $newName;

  #[JsonProperty('bookmarked')]
  public ?bool $bookmarked;

  /**
   * @param array{
   *   newName: string,
   *   bookmarked?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->newName = $values['newName'];
    $this->bookmarked = $values['bookmarked'] ?? null;

    $this->_dirtyFields = [
      'new_name' => true
    ];
    if (array_key_exists('bookmarked', $values)) {
      $this->_dirtyFields['bookmarked'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'new_name',
      'contents' => $this->newName
    ];

    if ($this->bookmarked !== null) {
      $parts[] = [
        'name' => 'bookmarked',
        'contents' => $this->bookmarked ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

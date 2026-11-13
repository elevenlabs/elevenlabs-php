<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Collections\Requests;

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
class BodyUpdateVoiceCollectionV1VoicesCollectionsCollectionIdPatch extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Title of the collection to create/update.
   */
  #[JsonProperty('title')]
  public ?string $title;

  /**
   * Icon of the collection to create/update.
   */
  #[JsonProperty('icon')]
  public ?string $icon;

  /**
   * @param array{
   *   title?: ?string,
   *   icon?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->title = $values['title'] ?? null;
    $this->icon = $values['icon'] ?? null;

    if (array_key_exists('title', $values)) {
      $this->_dirtyFields['title'] = true;
    }
    if (array_key_exists('icon', $values)) {
      $this->_dirtyFields['icon'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->title !== null) {
      $parts[] = [
        'name' => 'title',
        'contents' => $this->title
      ];
    }

    if ($this->icon !== null) {
      $parts[] = [
        'name' => 'icon',
        'contents' => $this->icon
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->title, 'title', maxLength: 1000);
    Validator::validateString($this->icon, 'icon', maxLength: 1000);
  }
}

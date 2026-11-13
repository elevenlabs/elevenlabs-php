<?php

declare(strict_types=1);

namespace ElevenLabs\Studio\Projects\Chapters\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyCreateChapterV1StudioProjectsProjectIdChaptersPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The name of the chapter, used for identification only.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * An optional URL from which we will extract content to initialize the Studio project. If this is set, 'from_url' and 'from_content' must be null. If neither 'from_url', 'from_document', 'from_content' are provided we will initialize the Studio project as blank.
   */
  #[JsonProperty('from_url')]
  public ?string $fromUrl;

  /**
   * @param array{
   *   name: string,
   *   fromUrl?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->fromUrl = $values['fromUrl'] ?? null;

    $this->_dirtyFields = [
      'name' => true
    ];
    if (array_key_exists('fromUrl', $values)) {
      $this->_dirtyFields['from_url'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->fromUrl !== null) {
      $parts[] = [
        'name' => 'from_url',
        'contents' => $this->fromUrl
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

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
class RegisterMediaResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('media_id', required: true)]
  public string $mediaId;

  /**
   * @param array{
   *   mediaId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->mediaId = $values['mediaId'];

    $this->_dirtyFields = [
      'media_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'media_id',
      'contents' => $this->mediaId
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->mediaId, 'media_id', pattern: '^prodmedia_[a-z0-9]{26}$');
  }
}

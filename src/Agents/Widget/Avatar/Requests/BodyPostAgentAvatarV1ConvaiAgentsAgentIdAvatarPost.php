<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Widget\Avatar\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyPostAgentAvatarV1ConvaiAgentsAgentIdAvatarPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Utils\File
   * An image file to be used as the agent's avatar.
   */
  #[JsonProperty('avatar_file', required: true)]
  public \ElevenLabs\Utils\File $avatarFile;

  /**
   * @param array{
   *   avatarFile: \ElevenLabs\Utils\File,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->avatarFile = $values['avatarFile'];

    $this->_dirtyFields = [
      'avatar_file' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = $this->avatarFile->toMultipartFormDataPart('avatar_file')->toGuzzlePart();

    return $parts;
  }

  public function validate(): void
  {
  }
}

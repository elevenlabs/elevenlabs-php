<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * A Voice Library voice the uploaded audio matched, offered in place of the clone.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class LibraryVoiceMatchResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the matched Voice Library voice.
   */
  #[JsonProperty('library_voice_id', required: true)]
  public string $libraryVoiceId;

  /**
   * The public owner ID of the Voice Library voice. Pass it with library_voice_id to POST /v1/voices/add/{public_user_id}/{voice_id} to add the voice.
   */
  #[JsonProperty('public_owner_id', required: true)]
  public string $publicOwnerId;

  /**
   * @param array{
   *   libraryVoiceId: string,
   *   publicOwnerId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->libraryVoiceId = $values['libraryVoiceId'];
    $this->publicOwnerId = $values['publicOwnerId'];

    $this->_dirtyFields = [
      'library_voice_id' => true,
      'public_owner_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'library_voice_id',
      'contents' => $this->libraryVoiceId
    ];

    $parts[] = [
      'name' => 'public_owner_id',
      'contents' => $this->publicOwnerId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

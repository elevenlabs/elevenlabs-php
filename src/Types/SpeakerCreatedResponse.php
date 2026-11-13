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
class SpeakerCreatedResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('version', required: true)]
  public int $version;

  #[JsonProperty('speaker_id', required: true)]
  public string $speakerId;

  /**
   * @param array{
   *   version: int,
   *   speakerId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->version = $values['version'];
    $this->speakerId = $values['speakerId'];

    $this->_dirtyFields = [
      'version' => true,
      'speaker_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'version',
      'contents' => (string) $this->version
    ];

    $parts[] = [
      'name' => 'speaker_id',
      'contents' => $this->speakerId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

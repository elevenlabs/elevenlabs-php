<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\HoldAudio\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyPostAgentHoldAudioV1ConvaiAgentsAgentIdHoldAudioPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Utils\File
   * An MP3 or WAV file played on loop to callers waiting in the agent's concurrency wait queue. Maximum size 40 MB, maximum duration 180 seconds.
   */
  #[JsonProperty('hold_audio_file', required: true)]
  public \ElevenLabs\Utils\File $holdAudioFile;

  /**
   * @param array{
   *   holdAudioFile: \ElevenLabs\Utils\File,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->holdAudioFile = $values['holdAudioFile'];

    $this->_dirtyFields = [
      'hold_audio_file' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = $this->holdAudioFile->toMultipartFormDataPart('hold_audio_file')->toGuzzlePart();

    return $parts;
  }

  public function validate(): void
  {
  }
}

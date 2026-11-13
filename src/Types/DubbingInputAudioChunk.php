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
class DubbingInputAudioChunk extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\DubbingInputAudioChunkMessageType>
   */
  #[JsonProperty('message_type', required: true)]
  public string $messageType;

  #[JsonProperty('audio_base_64', required: true)]
  public string $audioBase64;

  /**
   * @param array{
   *   messageType: value-of<\ElevenLabs\Types\DubbingInputAudioChunkMessageType>,
   *   audioBase64: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->messageType = $values['messageType'];
    $this->audioBase64 = $values['audioBase64'];

    $this->_dirtyFields = [
      'message_type' => true,
      'audio_base_64' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'message_type',
      'contents' => $this->messageType
    ];

    $parts[] = [
      'name' => 'audio_base_64',
      'contents' => $this->audioBase64
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->audioBase64, 'audio_base_64', minLength: 1);
  }
}

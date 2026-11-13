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
class TranslateAudio extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\TranslateAudioMessageType>
   */
  #[JsonProperty('message_type', required: true)]
  public string $messageType;

  #[JsonProperty('data', required: true)]
  public string $data;

  #[JsonProperty('sample_rate', required: true)]
  public int $sampleRate;

  /**
   * @param array{
   *   messageType: value-of<\ElevenLabs\Types\TranslateAudioMessageType>,
   *   data: string,
   *   sampleRate: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->messageType = $values['messageType'];
    $this->data = $values['data'];
    $this->sampleRate = $values['sampleRate'];

    $this->_dirtyFields = [
      'message_type' => true,
      'data' => true,
      'sample_rate' => true
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
      'name' => 'data',
      'contents' => $this->data
    ];

    $parts[] = [
      'name' => 'sample_rate',
      'contents' => (string) $this->sampleRate
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

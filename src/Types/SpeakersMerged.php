<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * With diarize, two speaker_ids turned out to be one person: every earlier use of
 * from_speaker_id, in partial or diarized transcripts, is to_speaker_id. Ids are never
 * reused; merges chain, so apply them in the order received.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SpeakersMerged extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\SpeakersMergedMessageType>
   */
  #[JsonProperty('message_type')]
  public ?string $messageType;

  #[JsonProperty('from_speaker_id', required: true)]
  public string $fromSpeakerId;

  #[JsonProperty('to_speaker_id', required: true)]
  public string $toSpeakerId;

  /**
   * @param array{
   *   fromSpeakerId: string,
   *   toSpeakerId: string,
   *   messageType?: ?value-of<\ElevenLabs\Types\SpeakersMergedMessageType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->messageType = $values['messageType'] ?? 'speakers_merged';
    $this->fromSpeakerId = $values['fromSpeakerId'];
    $this->toSpeakerId = $values['toSpeakerId'];

    $this->_dirtyFields = [
      'from_speaker_id' => true,
      'to_speaker_id' => true
    ];
    if (array_key_exists('messageType', $values)) {
      $this->_dirtyFields['message_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->messageType !== null) {
      $parts[] = [
        'name' => 'message_type',
        'contents' => $this->messageType
      ];
    }

    $parts[] = [
      'name' => 'from_speaker_id',
      'contents' => $this->fromSpeakerId
    ];

    $parts[] = [
      'name' => 'to_speaker_id',
      'contents' => $this->toSpeakerId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

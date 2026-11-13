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
class DubbingCommittedTranscript extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\DubbingCommittedTranscriptMessageType>
   */
  #[JsonProperty('message_type', required: true)]
  public string $messageType;

  #[JsonProperty('text', required: true)]
  public string $text;

  #[JsonProperty('segment_id', required: true)]
  public string $segmentId;

  #[JsonProperty('start_s', required: true)]
  public float $startS;

  #[JsonProperty('end_s', required: true)]
  public float $endS;

  #[JsonProperty('speaker_id', required: true)]
  public string $speakerId;

  /**
   * @param array{
   *   messageType: value-of<\ElevenLabs\Types\DubbingCommittedTranscriptMessageType>,
   *   text: string,
   *   segmentId: string,
   *   startS: float,
   *   endS: float,
   *   speakerId: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->messageType = $values['messageType'];
    $this->text = $values['text'];
    $this->segmentId = $values['segmentId'];
    $this->startS = $values['startS'];
    $this->endS = $values['endS'];
    $this->speakerId = $values['speakerId'];

    $this->_dirtyFields = [
      'message_type' => true,
      'text' => true,
      'segment_id' => true,
      'start_s' => true,
      'end_s' => true,
      'speaker_id' => true
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
      'name' => 'text',
      'contents' => $this->text
    ];

    $parts[] = [
      'name' => 'segment_id',
      'contents' => $this->segmentId
    ];

    $parts[] = [
      'name' => 'start_s',
      'contents' => (string) $this->startS
    ];

    $parts[] = [
      'name' => 'end_s',
      'contents' => (string) $this->endS
    ];

    $parts[] = [
      'name' => 'speaker_id',
      'contents' => $this->speakerId
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->text, 'text', minLength: 1);
    Validator::validateString($this->segmentId, 'segment_id', minLength: 1);
    Validator::validateNumber($this->startS, 'start_s', min: 0);
    Validator::validateNumber($this->endS, 'end_s', min: 0);
    Validator::validateString($this->speakerId, 'speaker_id', minLength: 1);
  }
}

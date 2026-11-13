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
class CommittedTranscript extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\CommittedTranscriptMessageType>
   */
  #[JsonProperty('message_type')]
  public ?string $messageType;

  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * Zero-based commit index when diarize is enabled. Matches the segment_index in the corresponding diarized_transcript.
   */
  #[JsonProperty('segment_index')]
  public ?int $segmentIndex;

  /**
   * @param array{
   *   text: string,
   *   messageType?: ?value-of<\ElevenLabs\Types\CommittedTranscriptMessageType>,
   *   segmentIndex?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->messageType = $values['messageType'] ?? 'committed_transcript';
    $this->text = $values['text'];
    $this->segmentIndex = $values['segmentIndex'] ?? null;

    $this->_dirtyFields = [
      'text' => true
    ];
    if (array_key_exists('messageType', $values)) {
      $this->_dirtyFields['message_type'] = true;
    }
    if (array_key_exists('segmentIndex', $values)) {
      $this->_dirtyFields['segment_index'] = true;
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
      'name' => 'text',
      'contents' => $this->text
    ];

    if ($this->segmentIndex !== null) {
      $parts[] = [
        'name' => 'segment_index',
        'contents' => (string) $this->segmentIndex
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

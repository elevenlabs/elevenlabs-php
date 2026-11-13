<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * With diarize, a committed transcript's words with their final speakers, sent after
 * its committed_transcript (which never waits for them), in commit order.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DiarizedTranscript extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\DiarizedTranscriptMessageType>
   */
  #[JsonProperty('message_type')]
  public ?string $messageType;

  /**
   * The segment_index of the committed_transcript the words are of.
   */
  #[JsonProperty('segment_index', required: true)]
  public int $segmentIndex;

  /**
   * The committed transcript text the words are of.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * @var \ElevenLabs\Types\DiarizedTranscriptWordsItem[]
   * The words, as in batch diarization, each with its speaker_id, null where the speaker could not be identified.
   */
  #[
    JsonProperty('words', required: true),
    ArrayType([\ElevenLabs\Types\DiarizedTranscriptWordsItem::class])
  ]
  public array $words;

  /**
   * @param array{
   *   segmentIndex: int,
   *   text: string,
   *   words: \ElevenLabs\Types\DiarizedTranscriptWordsItem[],
   *   messageType?: ?value-of<\ElevenLabs\Types\DiarizedTranscriptMessageType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->messageType = $values['messageType'] ?? 'diarized_transcript';
    $this->segmentIndex = $values['segmentIndex'];
    $this->text = $values['text'];
    $this->words = $values['words'];

    $this->_dirtyFields = [
      'segment_index' => true,
      'text' => true,
      'words' => true
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
      'name' => 'segment_index',
      'contents' => (string) $this->segmentIndex
    ];

    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    $parts[] = [
      'name' => 'words',
      'contents' => json_encode($this->words),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->words as $item) {
      $item->validate();
    }
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Word-level detail of the transcription with timing information.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class PartialTranscriptWordsItem extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The word or sound that was transcribed.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * The start time of the word or sound in seconds.
   */
  #[JsonProperty('start')]
  public ?float $start;

  /**
   * The end time of the word or sound in seconds.
   */
  #[JsonProperty('end')]
  public ?float $end;

  /**
   * @var value-of<\ElevenLabs\Types\SpeechToTextWordResponseModelType>
   * The type of the word or sound. 'audio_event' is used for non-word sounds like laughter or footsteps.
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * Unique identifier for the speaker of this word.
   */
  #[JsonProperty('speaker_id')]
  public ?string $speakerId;

  /**
   * The log of the probability with which this word was predicted. Logprobs are in range [-infinity, 0], higher logprobs indicate a higher confidence the model has in its predictions.
   */
  #[JsonProperty('logprob', required: true)]
  public float $logprob;

  /**
   * @var \ElevenLabs\Types\PartialTranscriptWordsItemCharactersItem[]|null
   * The characters that make up the word and their timing information.
   */
  #[
    JsonProperty('characters'),
    ArrayType([\ElevenLabs\Types\PartialTranscriptWordsItemCharactersItem::class])
  ]
  public ?array $characters;

  /**
   * The channel this word was spoken on (for multichannel audio). Null for single-channel transcriptions.
   */
  #[JsonProperty('channel_index')]
  public ?int $channelIndex;

  /**
   * @param array{
   *   text: string,
   *   type: value-of<\ElevenLabs\Types\SpeechToTextWordResponseModelType>,
   *   logprob: float,
   *   start?: ?float,
   *   end?: ?float,
   *   speakerId?: ?string,
   *   characters?: \ElevenLabs\Types\PartialTranscriptWordsItemCharactersItem[]|null,
   *   channelIndex?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->text = $values['text'];
    $this->start = $values['start'] ?? null;
    $this->end = $values['end'] ?? null;
    $this->type = $values['type'];
    $this->speakerId = $values['speakerId'] ?? null;
    $this->logprob = $values['logprob'];
    $this->characters = $values['characters'] ?? null;
    $this->channelIndex = $values['channelIndex'] ?? null;

    $this->_dirtyFields = [
      'text' => true,
      'type' => true,
      'logprob' => true
    ];
    if (array_key_exists('start', $values)) {
      $this->_dirtyFields['start'] = true;
    }
    if (array_key_exists('end', $values)) {
      $this->_dirtyFields['end'] = true;
    }
    if (array_key_exists('speakerId', $values)) {
      $this->_dirtyFields['speaker_id'] = true;
    }
    if (array_key_exists('characters', $values)) {
      $this->_dirtyFields['characters'] = true;
    }
    if (array_key_exists('channelIndex', $values)) {
      $this->_dirtyFields['channel_index'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    if ($this->start !== null) {
      $parts[] = [
        'name' => 'start',
        'contents' => (string) $this->start
      ];
    }

    if ($this->end !== null) {
      $parts[] = [
        'name' => 'end',
        'contents' => (string) $this->end
      ];
    }

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    if ($this->speakerId !== null) {
      $parts[] = [
        'name' => 'speaker_id',
        'contents' => $this->speakerId
      ];
    }

    $parts[] = [
      'name' => 'logprob',
      'contents' => (string) $this->logprob
    ];

    if ($this->characters !== null) {
      $parts[] = [
        'name' => 'characters',
        'contents' => json_encode($this->characters),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->channelIndex !== null) {
      $parts[] = [
        'name' => 'channel_index',
        'contents' => (string) $this->channelIndex
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->characters ?? [] as $item) {
      $item->validate();
    }
  }
}

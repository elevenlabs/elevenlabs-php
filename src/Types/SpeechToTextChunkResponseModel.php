<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Chunk-level detail of the transcription with timing information.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SpeechToTextChunkResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The detected language code (e.g. 'eng' for English).
   */
  #[JsonProperty('language_code', required: true)]
  public string $languageCode;

  /**
   * The confidence score of the language detection (0 to 1).
   */
  #[JsonProperty('language_probability', required: true)]
  public float $languageProbability;

  /**
   * The raw text of the transcription.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * @var \ElevenLabs\Types\SpeechToTextWordResponseModel[]
   * List of words with their timing information.
   */
  #[
    JsonProperty('words', required: true),
    ArrayType([\ElevenLabs\Types\SpeechToTextWordResponseModel::class])
  ]
  public array $words;

  /**
   * The channel index this transcript belongs to (for multichannel audio).
   */
  #[JsonProperty('channel_index')]
  public ?int $channelIndex;

  /**
   * @var \ElevenLabs\Types\AdditionalFormatResponseModel[]|null
   * Requested additional formats of the transcript.
   */
  #[
    JsonProperty('additional_formats'),
    ArrayType([\ElevenLabs\Types\AdditionalFormatResponseModel::class])
  ]
  public ?array $additionalFormats;

  /**
   * The transcription ID of the response.
   */
  #[JsonProperty('transcription_id')]
  public ?string $transcriptionId;

  /**
   * @var \ElevenLabs\Types\DetectedEntity[]|null
   * List of detected entities with their text, type, and character positions in the transcript.
   */
  #[JsonProperty('entities'), ArrayType([\ElevenLabs\Types\DetectedEntity::class])]
  public ?array $entities;

  /**
   * The duration of the audio that was transcribed in seconds.
   */
  #[JsonProperty('audio_duration_secs')]
  public ?float $audioDurationSecs;

  /**
   * Result of the optional transcript edit: the edited text, or an error if it could not be produced. Absent when no edit was requested. On success, both `text` and `edited_text` hold the edited transcript; compare them with the top-level `text` to see what changed.
   */
  #[JsonProperty('edited_transcript')]
  public ?\ElevenLabs\Types\SpeechToTextChunkResponseModelEditedTranscript $editedTranscript;

  /**
   * @param array{
   *   languageCode: string,
   *   languageProbability: float,
   *   text: string,
   *   words: \ElevenLabs\Types\SpeechToTextWordResponseModel[],
   *   channelIndex?: ?int,
   *   additionalFormats?: \ElevenLabs\Types\AdditionalFormatResponseModel[]|null,
   *   transcriptionId?: ?string,
   *   entities?: \ElevenLabs\Types\DetectedEntity[]|null,
   *   audioDurationSecs?: ?float,
   *   editedTranscript?: ?\ElevenLabs\Types\SpeechToTextChunkResponseModelEditedTranscript,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->languageCode = $values['languageCode'];
    $this->languageProbability = $values['languageProbability'];
    $this->text = $values['text'];
    $this->words = $values['words'];
    $this->channelIndex = $values['channelIndex'] ?? null;
    $this->additionalFormats = $values['additionalFormats'] ?? null;
    $this->transcriptionId = $values['transcriptionId'] ?? null;
    $this->entities = $values['entities'] ?? null;
    $this->audioDurationSecs = $values['audioDurationSecs'] ?? null;
    $this->editedTranscript = $values['editedTranscript'] ?? null;

    $this->_dirtyFields = [
      'language_code' => true,
      'language_probability' => true,
      'text' => true,
      'words' => true
    ];
    if (array_key_exists('channelIndex', $values)) {
      $this->_dirtyFields['channel_index'] = true;
    }
    if (array_key_exists('additionalFormats', $values)) {
      $this->_dirtyFields['additional_formats'] = true;
    }
    if (array_key_exists('transcriptionId', $values)) {
      $this->_dirtyFields['transcription_id'] = true;
    }
    if (array_key_exists('entities', $values)) {
      $this->_dirtyFields['entities'] = true;
    }
    if (array_key_exists('audioDurationSecs', $values)) {
      $this->_dirtyFields['audio_duration_secs'] = true;
    }
    if (array_key_exists('editedTranscript', $values)) {
      $this->_dirtyFields['edited_transcript'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'language_code',
      'contents' => $this->languageCode
    ];

    $parts[] = [
      'name' => 'language_probability',
      'contents' => (string) $this->languageProbability
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

    if ($this->channelIndex !== null) {
      $parts[] = [
        'name' => 'channel_index',
        'contents' => (string) $this->channelIndex
      ];
    }

    if ($this->additionalFormats !== null) {
      $parts[] = [
        'name' => 'additional_formats',
        'contents' => json_encode($this->additionalFormats),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->transcriptionId !== null) {
      $parts[] = [
        'name' => 'transcription_id',
        'contents' => $this->transcriptionId
      ];
    }

    if ($this->entities !== null) {
      $parts[] = [
        'name' => 'entities',
        'contents' => json_encode($this->entities),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->audioDurationSecs !== null) {
      $parts[] = [
        'name' => 'audio_duration_secs',
        'contents' => (string) $this->audioDurationSecs
      ];
    }

    if ($this->editedTranscript !== null) {
      $parts[] = [
        'name' => 'edited_transcript',
        'contents' => json_encode($this->editedTranscript),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->words as $item) {
      $item->validate();
    }
    foreach ($this->additionalFormats ?? [] as $item) {
      $item->validate();
    }
    foreach ($this->entities ?? [] as $item) {
      $item->validate();
    }
  }
}

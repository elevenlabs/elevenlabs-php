<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Response model for multichannel speech-to-text transcription.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class MultichannelSpeechToTextResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\SpeechToTextChunkResponseModel[]
   * List of transcripts, one for each audio channel. Each transcript contains the text and word-level details for its respective channel.
   */
  #[
    JsonProperty('transcripts', required: true),
    ArrayType([\ElevenLabs\Types\SpeechToTextChunkResponseModel::class])
  ]
  public array $transcripts;

  /**
   * The transcription ID of the response.
   */
  #[JsonProperty('transcription_id')]
  public ?string $transcriptionId;

  /**
   * The duration of the audio that was transcribed across all channels in seconds.
   */
  #[JsonProperty('audio_duration_secs')]
  public ?float $audioDurationSecs;

  /**
   * @param array{
   *   transcripts: \ElevenLabs\Types\SpeechToTextChunkResponseModel[],
   *   transcriptionId?: ?string,
   *   audioDurationSecs?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->transcripts = $values['transcripts'];
    $this->transcriptionId = $values['transcriptionId'] ?? null;
    $this->audioDurationSecs = $values['audioDurationSecs'] ?? null;

    $this->_dirtyFields = [
      'transcripts' => true
    ];
    if (array_key_exists('transcriptionId', $values)) {
      $this->_dirtyFields['transcription_id'] = true;
    }
    if (array_key_exists('audioDurationSecs', $values)) {
      $this->_dirtyFields['audio_duration_secs'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'transcripts',
      'contents' => json_encode($this->transcripts),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->transcriptionId !== null) {
      $parts[] = [
        'name' => 'transcription_id',
        'contents' => $this->transcriptionId
      ];
    }

    if ($this->audioDurationSecs !== null) {
      $parts[] = [
        'name' => 'audio_duration_secs',
        'contents' => (string) $this->audioDurationSecs
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->transcripts as $item) {
      $item->validate();
    }
  }
}

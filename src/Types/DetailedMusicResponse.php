<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;

/**
 * Response model for structured music generation endpoint
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DetailedMusicResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The composition plan used to generate the song
   */
  #[
    JsonProperty('composition_plan', required: true),
    Union(\ElevenLabs\Types\MusicPrompt::class, \ElevenLabs\Types\CompositionPlan::class)
  ]
  public \ElevenLabs\Types\MusicPrompt|\ElevenLabs\Types\CompositionPlan $compositionPlan;

  #[JsonProperty('song_metadata', required: true)]
  public \ElevenLabs\Types\SongMetadata $songMetadata;

  /**
   * @var \ElevenLabs\Types\WordTimestamp[]|null
   * The timestamps of the words in the generated song
   */
  #[
    JsonProperty('words_timestamps', required: true),
    ArrayType([\ElevenLabs\Types\WordTimestamp::class])
  ]
  public ?array $wordsTimestamps;

  /**
   * @var int[]|null
   * A low-resolution waveform of the generated song, for showing a preview of it. Holds 4 values per second of audio, from -1000 to 1000. Stereo is mixed down to a single channel. Only present if `with_waveform_visual` was True in the request body.
   */
  #[JsonProperty('waveform_visual'), ArrayType(['integer'])]
  public ?array $waveformVisual;

  /**
   * @param array{
   *   compositionPlan: \ElevenLabs\Types\MusicPrompt|\ElevenLabs\Types\CompositionPlan,
   *   songMetadata: \ElevenLabs\Types\SongMetadata,
   *   wordsTimestamps: \ElevenLabs\Types\WordTimestamp[]|null,
   *   waveformVisual?: int[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->compositionPlan = $values['compositionPlan'];
    $this->songMetadata = $values['songMetadata'];
    $this->wordsTimestamps = $values['wordsTimestamps'];
    $this->waveformVisual = $values['waveformVisual'] ?? null;

    $this->_dirtyFields = [
      'composition_plan' => true,
      'song_metadata' => true,
      'words_timestamps' => true
    ];
    if (array_key_exists('waveformVisual', $values)) {
      $this->_dirtyFields['waveform_visual'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'composition_plan',
      'contents' => json_encode($this->compositionPlan),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'song_metadata',
      'contents' => json_encode($this->songMetadata),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'words_timestamps',
      'contents' => json_encode($this->wordsTimestamps),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->waveformVisual !== null) {
      foreach ($this->waveformVisual ?? [] as $item) {
        $parts[] = [
          'name' => 'waveform_visual',
          'contents' => (string) $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->songMetadata->validate();
    foreach ($this->wordsTimestamps ?? [] as $item) {
      $item->validate();
    }
  }
}

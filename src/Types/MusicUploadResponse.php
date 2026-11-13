<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;

/**
 * Response model for music upload endpoint.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class MusicUploadResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Unique identifier for the uploaded song
   */
  #[JsonProperty('song_id', required: true)]
  public string $songId;

  /**
   * The composition plan extracted from the uploaded song. Only present if `extract_composition_plan` was provided in the request body.
   */
  #[
    JsonProperty('composition_plan'),
    Union(\ElevenLabs\Types\MusicPrompt::class, \ElevenLabs\Types\CompositionPlan::class, 'null')
  ]
  public \ElevenLabs\Types\MusicPrompt|\ElevenLabs\Types\CompositionPlan|null $compositionPlan;

  /**
   * @var \ElevenLabs\Types\WordTimestamp[]|null
   * Word-level timestamps transcribed from the uploaded song. Only present if `with_timestamps` was True in the request body
   */
  #[JsonProperty('words_timestamps'), ArrayType([\ElevenLabs\Types\WordTimestamp::class])]
  public ?array $wordsTimestamps;

  /**
   * @var int[]|null
   * A low-resolution waveform of the uploaded song, for showing a preview of it. Holds 4 values per second of audio, from -1000 to 1000. Stereo is mixed down to a single channel. Only present if `with_waveform_visual` was True in the request body.
   */
  #[JsonProperty('waveform_visual'), ArrayType(['integer'])]
  public ?array $waveformVisual;

  /**
   * @param array{
   *   songId: string,
   *   compositionPlan?: \ElevenLabs\Types\MusicPrompt|\ElevenLabs\Types\CompositionPlan|null,
   *   wordsTimestamps?: \ElevenLabs\Types\WordTimestamp[]|null,
   *   waveformVisual?: int[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->songId = $values['songId'];
    $this->compositionPlan = $values['compositionPlan'] ?? null;
    $this->wordsTimestamps = $values['wordsTimestamps'] ?? null;
    $this->waveformVisual = $values['waveformVisual'] ?? null;

    $this->_dirtyFields = [
      'song_id' => true
    ];
    if (array_key_exists('compositionPlan', $values)) {
      $this->_dirtyFields['composition_plan'] = true;
    }
    if (array_key_exists('wordsTimestamps', $values)) {
      $this->_dirtyFields['words_timestamps'] = true;
    }
    if (array_key_exists('waveformVisual', $values)) {
      $this->_dirtyFields['waveform_visual'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'song_id',
      'contents' => $this->songId
    ];

    if ($this->compositionPlan !== null) {
      $parts[] = [
        'name' => 'composition_plan',
        'contents' => json_encode($this->compositionPlan),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->wordsTimestamps !== null) {
      $parts[] = [
        'name' => 'words_timestamps',
        'contents' => json_encode($this->wordsTimestamps),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

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
    foreach ($this->wordsTimestamps ?? [] as $item) {
      $item->validate();
    }
  }
}

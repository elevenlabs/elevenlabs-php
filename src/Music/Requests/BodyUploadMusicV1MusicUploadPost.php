<?php

declare(strict_types=1);

namespace ElevenLabs\Music\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\Union;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyUploadMusicV1MusicUploadPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Utils\File
   * The audio file to upload.
   */
  #[JsonProperty('file', required: true)]
  public \ElevenLabs\Utils\File $file;

  /**
   * Whether to generate and return the composition plan for the uploaded song. Pass a model id (`music_v1`, `music_v2` or `music_v2_5`) to control which composition plan format is returned. Passing `true`/`false` is deprecated; `true` defaults to the `music_v1` plan format. Enabling this will increase the latency.
   */
  #[JsonProperty('extract_composition_plan'), Union('bool', 'string', 'null')]
  public bool|string|null $extractCompositionPlan;

  /**
   * Whether to transcribe the uploaded song and return word-level timestamps. If True, the response will include words_timestamps but will increase the latency.
   */
  #[JsonProperty('with_timestamps')]
  public ?bool $withTimestamps;

  /**
   * Whether to return the visual waveform of the uploaded song.
   */
  #[JsonProperty('with_waveform_visual')]
  public ?bool $withWaveformVisual;

  /**
   * @param array{
   *   file: \ElevenLabs\Utils\File,
   *   extractCompositionPlan?: bool|string|null,
   *   withTimestamps?: ?bool,
   *   withWaveformVisual?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->file = $values['file'];
    $this->extractCompositionPlan = $values['extractCompositionPlan'] ?? null;
    $this->withTimestamps = $values['withTimestamps'] ?? null;
    $this->withWaveformVisual = $values['withWaveformVisual'] ?? null;

    $this->_dirtyFields = [
      'file' => true
    ];
    if (array_key_exists('extractCompositionPlan', $values)) {
      $this->_dirtyFields['extract_composition_plan'] = true;
    }
    if (array_key_exists('withTimestamps', $values)) {
      $this->_dirtyFields['with_timestamps'] = true;
    }
    if (array_key_exists('withWaveformVisual', $values)) {
      $this->_dirtyFields['with_waveform_visual'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = $this->file->toMultipartFormDataPart('file')->toGuzzlePart();

    if ($this->extractCompositionPlan !== null) {
      $parts[] = [
        'name' => 'extract_composition_plan',
        'contents' => json_encode($this->extractCompositionPlan),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->withTimestamps !== null) {
      $parts[] = [
        'name' => 'with_timestamps',
        'contents' => $this->withTimestamps ? 'true' : 'false'
      ];
    }

    if ($this->withWaveformVisual !== null) {
      $parts[] = [
        'name' => 'with_waveform_visual',
        'contents' => $this->withWaveformVisual ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

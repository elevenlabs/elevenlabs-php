<?php

declare(strict_types=1);

namespace ElevenLabs\Music\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\Union;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyComposeMusicWithADetailedResponseV1MusicDetailedPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Music\Types\ComposeDetailedMusicRequestOutputFormat>
   * Output format of the generated audio. Formatted as codec_sample_rate_bitrate. Use "auto" (the default) to let the API pick the best format for the selected model: mp3_44100_128 for v1 models and mp3_48000_192 for v2 models.
   */
  public ?string $outputFormat;

  /**
   * When enable_logging is set to false zero retention mode will be used for the request. Zero retention mode may only be used by enterprise customers.
   */
  public ?bool $enableLogging;

  /**
   * A simple text prompt to generate a song from. Cannot be used in conjunction with `composition_plan`.
   */
  #[JsonProperty('prompt')]
  public ?string $prompt;

  /**
   * A detailed composition plan to guide music generation. Cannot be used in conjunction with `prompt`.
   */
  #[
    JsonProperty('composition_plan'),
    Union(\ElevenLabs\Types\MusicPrompt::class, \ElevenLabs\Types\CompositionPlan::class, 'null')
  ]
  public \ElevenLabs\Types\MusicPrompt|\ElevenLabs\Types\CompositionPlan|null $compositionPlan;

  /**
   * The length of the song to generate in milliseconds. Used only in conjunction with `prompt`. Must be between 3000ms and 600000ms. Optional - if not provided, the model will choose a length based on the prompt.
   */
  #[JsonProperty('music_length_ms')]
  public ?int $musicLengthMs;

  /**
   * @var ?value-of<\ElevenLabs\Types\MusicModelId>
   */
  #[JsonProperty('model_id')]
  public ?string $modelId;

  /**
   * Random seed to initialize the music generation process. Providing the same seed with the same parameters can help achieve more consistent results, but exact reproducibility is not guaranteed and outputs may change across system updates. Cannot be used in conjunction with prompt.
   */
  #[JsonProperty('seed')]
  public ?int $seed;

  /**
   * If true, guarantees that the generated song will be instrumental. If false, the song may or may not be instrumental depending on the `prompt`. Can only be used with `prompt`.
   */
  #[JsonProperty('force_instrumental')]
  public ?bool $forceInstrumental;

  /**
   * The ID of the finetune to use for the generation
   */
  #[JsonProperty('finetune_id')]
  public ?string $finetuneId;

  /**
   * Controls how strictly section durations in the `composition_plan` are enforced. Only used with `composition_plan` and only applies to `music_v1`; for `music_v2` and `music_v2_5` section durations are always enforced and this is ignored. When false for `music_v1`, the model may adjust individual section durations for better quality and latency, while preserving the total song duration from the plan.
   */
  #[JsonProperty('respect_sections_durations')]
  public ?bool $respectSectionsDurations;

  /**
   * Whether to store the generated song for inpainting.
   */
  #[JsonProperty('store_for_inpainting')]
  public ?bool $storeForInpainting;

  /**
   * Whether to return the timestamps of the words in the generated song.
   */
  #[JsonProperty('with_timestamps')]
  public ?bool $withTimestamps;

  /**
   * Whether to return the visual waveform of the generated song.
   */
  #[JsonProperty('with_waveform_visual')]
  public ?bool $withWaveformVisual;

  /**
   * Whether to sign the generated song with C2PA. Applicable only for mp3 files.
   */
  #[JsonProperty('sign_with_c2pa')]
  public ?bool $signWithC2Pa;

  /**
   * @param array{
   *   outputFormat?: ?value-of<\ElevenLabs\Music\Types\ComposeDetailedMusicRequestOutputFormat>,
   *   enableLogging?: ?bool,
   *   prompt?: ?string,
   *   compositionPlan?: \ElevenLabs\Types\MusicPrompt|\ElevenLabs\Types\CompositionPlan|null,
   *   musicLengthMs?: ?int,
   *   modelId?: ?value-of<\ElevenLabs\Types\MusicModelId>,
   *   seed?: ?int,
   *   forceInstrumental?: ?bool,
   *   finetuneId?: ?string,
   *   respectSectionsDurations?: ?bool,
   *   storeForInpainting?: ?bool,
   *   withTimestamps?: ?bool,
   *   withWaveformVisual?: ?bool,
   *   signWithC2Pa?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->outputFormat = $values['outputFormat'] ?? null;
    $this->enableLogging = $values['enableLogging'] ?? null;
    $this->prompt = $values['prompt'] ?? null;
    $this->compositionPlan = $values['compositionPlan'] ?? null;
    $this->musicLengthMs = $values['musicLengthMs'] ?? null;
    $this->modelId = $values['modelId'] ?? null;
    $this->seed = $values['seed'] ?? null;
    $this->forceInstrumental = $values['forceInstrumental'] ?? null;
    $this->finetuneId = $values['finetuneId'] ?? null;
    $this->respectSectionsDurations = $values['respectSectionsDurations'] ?? null;
    $this->storeForInpainting = $values['storeForInpainting'] ?? null;
    $this->withTimestamps = $values['withTimestamps'] ?? null;
    $this->withWaveformVisual = $values['withWaveformVisual'] ?? null;
    $this->signWithC2Pa = $values['signWithC2Pa'] ?? null;

    if (array_key_exists('prompt', $values)) {
      $this->_dirtyFields['prompt'] = true;
    }
    if (array_key_exists('compositionPlan', $values)) {
      $this->_dirtyFields['composition_plan'] = true;
    }
    if (array_key_exists('musicLengthMs', $values)) {
      $this->_dirtyFields['music_length_ms'] = true;
    }
    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
    }
    if (array_key_exists('seed', $values)) {
      $this->_dirtyFields['seed'] = true;
    }
    if (array_key_exists('forceInstrumental', $values)) {
      $this->_dirtyFields['force_instrumental'] = true;
    }
    if (array_key_exists('finetuneId', $values)) {
      $this->_dirtyFields['finetune_id'] = true;
    }
    if (array_key_exists('respectSectionsDurations', $values)) {
      $this->_dirtyFields['respect_sections_durations'] = true;
    }
    if (array_key_exists('storeForInpainting', $values)) {
      $this->_dirtyFields['store_for_inpainting'] = true;
    }
    if (array_key_exists('withTimestamps', $values)) {
      $this->_dirtyFields['with_timestamps'] = true;
    }
    if (array_key_exists('withWaveformVisual', $values)) {
      $this->_dirtyFields['with_waveform_visual'] = true;
    }
    if (array_key_exists('signWithC2Pa', $values)) {
      $this->_dirtyFields['sign_with_c2pa'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->prompt !== null) {
      $parts[] = [
        'name' => 'prompt',
        'contents' => $this->prompt
      ];
    }

    if ($this->compositionPlan !== null) {
      $parts[] = [
        'name' => 'composition_plan',
        'contents' => json_encode($this->compositionPlan),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->musicLengthMs !== null) {
      $parts[] = [
        'name' => 'music_length_ms',
        'contents' => (string) $this->musicLengthMs
      ];
    }

    if ($this->modelId !== null) {
      $parts[] = [
        'name' => 'model_id',
        'contents' => $this->modelId
      ];
    }

    if ($this->seed !== null) {
      $parts[] = [
        'name' => 'seed',
        'contents' => (string) $this->seed
      ];
    }

    if ($this->forceInstrumental !== null) {
      $parts[] = [
        'name' => 'force_instrumental',
        'contents' => $this->forceInstrumental ? 'true' : 'false'
      ];
    }

    if ($this->finetuneId !== null) {
      $parts[] = [
        'name' => 'finetune_id',
        'contents' => $this->finetuneId
      ];
    }

    if ($this->respectSectionsDurations !== null) {
      $parts[] = [
        'name' => 'respect_sections_durations',
        'contents' => $this->respectSectionsDurations ? 'true' : 'false'
      ];
    }

    if ($this->storeForInpainting !== null) {
      $parts[] = [
        'name' => 'store_for_inpainting',
        'contents' => $this->storeForInpainting ? 'true' : 'false'
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

    if ($this->signWithC2Pa !== null) {
      $parts[] = [
        'name' => 'sign_with_c2pa',
        'contents' => $this->signWithC2Pa ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->prompt, 'prompt', maxLength: 4100);
    Validator::validateNumber($this->musicLengthMs, 'music_length_ms', min: 3000, max: 600000);
    Validator::validateNumber($this->seed, 'seed', min: 0, max: 2147483647);
    Validator::validateString($this->finetuneId, 'finetune_id', maxLength: 100);
  }
}

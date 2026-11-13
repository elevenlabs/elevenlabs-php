<?php

declare(strict_types=1);

namespace ElevenLabs\Music\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyVideoToMusicV1MusicVideoToMusicPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AllowedOutputFormats>
   * Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
   */
  public ?string $outputFormat;

  /**
   * When enable_logging is set to false zero retention mode will be used for the request. Zero retention mode may only be used by enterprise customers.
   */
  public ?bool $enableLogging;

  /**
   * @var mixed[]
   *
   *             One or more video files sent via FormData array (multipart/form-data). They will be combined into one codec in order.
   *             A maximum of 10 videos is allowed, where the total size of the combined video is limited to 200MB.
   *             In total, the video can be up to 600 seconds long. Note that combining multiple videos may increase the request duration significantly. If possible, combine the videos beforehand.
   *
   */
  #[JsonProperty('videos', required: true)]
  public array $videos;

  /**
   * Optional text description of the music you want. A maximum of 4100 characters is allowed.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var string[]|null
   * Optional list of style tags (e.g. ['upbeat', 'cinematic']). A maximum of 10 tags is allowed.
   */
  #[JsonProperty('tags'), ArrayType(['string'])]
  public ?array $tags;

  /**
   * @var ?value-of<\ElevenLabs\Types\MusicModelId>
   */
  #[JsonProperty('model_id')]
  public ?string $modelId;

  /**
   * When true, incorporate SFX cues from the video.
   */
  #[JsonProperty('add_sfx')]
  public ?bool $addSfx;

  /**
   * When true, return a ZIP with separate music and SFX audio tracks instead of a single mixed file. Use this for more flexibility to layer the tracks.
   */
  #[JsonProperty('separate_tracks')]
  public ?bool $separateTracks;

  /**
   * When true, analyze the video's audio track and use its genres, BPM, instrumentation, mood, and arc as reference characteristics for music generation.
   */
  #[JsonProperty('use_audio_as_reference')]
  public ?bool $useAudioAsReference;

  /**
   * Whether to sign the generated song with C2PA. Applicable only for mp3 files.
   */
  #[JsonProperty('sign_with_c2pa')]
  public ?bool $signWithC2Pa;

  /**
   * @param array{
   *   videos: mixed[],
   *   outputFormat?: ?value-of<\ElevenLabs\Types\AllowedOutputFormats>,
   *   enableLogging?: ?bool,
   *   description?: ?string,
   *   tags?: string[]|null,
   *   modelId?: ?value-of<\ElevenLabs\Types\MusicModelId>,
   *   addSfx?: ?bool,
   *   separateTracks?: ?bool,
   *   useAudioAsReference?: ?bool,
   *   signWithC2Pa?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->outputFormat = $values['outputFormat'] ?? null;
    $this->enableLogging = $values['enableLogging'] ?? null;
    $this->videos = $values['videos'];
    $this->description = $values['description'] ?? null;
    $this->tags = $values['tags'] ?? null;
    $this->modelId = $values['modelId'] ?? null;
    $this->addSfx = $values['addSfx'] ?? null;
    $this->separateTracks = $values['separateTracks'] ?? null;
    $this->useAudioAsReference = $values['useAudioAsReference'] ?? null;
    $this->signWithC2Pa = $values['signWithC2Pa'] ?? null;

    $this->_dirtyFields = [
      'videos' => true
    ];
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('tags', $values)) {
      $this->_dirtyFields['tags'] = true;
    }
    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
    }
    if (array_key_exists('addSfx', $values)) {
      $this->_dirtyFields['add_sfx'] = true;
    }
    if (array_key_exists('separateTracks', $values)) {
      $this->_dirtyFields['separate_tracks'] = true;
    }
    if (array_key_exists('useAudioAsReference', $values)) {
      $this->_dirtyFields['use_audio_as_reference'] = true;
    }
    if (array_key_exists('signWithC2Pa', $values)) {
      $this->_dirtyFields['sign_with_c2pa'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->videos as $item) {
      $parts[] = $item->toMultipartFormDataPart('videos')->toGuzzlePart();
    }

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->tags !== null) {
      foreach ($this->tags ?? [] as $item) {
        $parts[] = [
          'name' => 'tags',
          'contents' => $item
        ];
      }
    }

    if ($this->modelId !== null) {
      $parts[] = [
        'name' => 'model_id',
        'contents' => $this->modelId
      ];
    }

    if ($this->addSfx !== null) {
      $parts[] = [
        'name' => 'add_sfx',
        'contents' => $this->addSfx ? 'true' : 'false'
      ];
    }

    if ($this->separateTracks !== null) {
      $parts[] = [
        'name' => 'separate_tracks',
        'contents' => $this->separateTracks ? 'true' : 'false'
      ];
    }

    if ($this->useAudioAsReference !== null) {
      $parts[] = [
        'name' => 'use_audio_as_reference',
        'contents' => $this->useAudioAsReference ? 'true' : 'false'
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
    Validator::validateArray($this->videos, 'videos', minItems: 1, maxItems: 10);
    Validator::validateString($this->description, 'description', minLength: 1, maxLength: 4100);
    Validator::validateArray($this->tags, 'tags', minItems: 0, maxItems: 10);
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyDubAVideoOrAnAudioFileV1DubbingPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?\ElevenLabs\Utils\File
   * A list of file paths to audio recordings intended for voice cloning
   */
  #[JsonProperty('file')]
  public ?\ElevenLabs\Utils\File $file;

  /**
   * @var ?\ElevenLabs\Utils\File
   * CSV file containing transcription/translation metadata
   */
  #[JsonProperty('csv_file')]
  public ?\ElevenLabs\Utils\File $csvFile;

  /**
   * @var ?\ElevenLabs\Utils\File
   * For use only with csv input
   */
  #[JsonProperty('foreground_audio_file')]
  public ?\ElevenLabs\Utils\File $foregroundAudioFile;

  /**
   * @var ?\ElevenLabs\Utils\File
   * For use only with csv input
   */
  #[JsonProperty('background_audio_file')]
  public ?\ElevenLabs\Utils\File $backgroundAudioFile;

  /**
   * Name of the dubbing project.
   */
  #[JsonProperty('name')]
  public ?string $name;

  /**
   * URL of the source video/audio file.
   */
  #[JsonProperty('source_url')]
  public ?string $sourceUrl;

  /**
   * Source language. Expects a valid iso639-1 or iso639-3 language code.
   */
  #[JsonProperty('source_lang')]
  public ?string $sourceLang;

  /**
   * The Target language to dub the content into. Expects a valid iso639-1 or iso639-3 language code.
   */
  #[JsonProperty('target_lang', required: true)]
  public ?string $targetLang;

  /**
   * [Experimental] An accent to apply when selecting voices from the library and to use to inform translation of the dialect to prefer.
   */
  #[JsonProperty('target_accent')]
  public ?string $targetAccent;

  /**
   * Number of speakers to use for the dubbing. Set to 0 to automatically detect the number of speakers
   */
  #[JsonProperty('num_speakers')]
  public ?int $numSpeakers;

  /**
   * Whether to apply watermark to the output video.
   */
  #[JsonProperty('watermark')]
  public ?bool $watermark;

  /**
   * Start time of the source video/audio file.
   */
  #[JsonProperty('start_time')]
  public ?int $startTime;

  /**
   * End time of the source video/audio file.
   */
  #[JsonProperty('end_time')]
  public ?int $endTime;

  /**
   * Whether to use the highest resolution available.
   */
  #[JsonProperty('highest_resolution')]
  public ?bool $highestResolution;

  /**
   * An advanced setting. Whether to drop background audio from the final dub. This can improve dub quality where it's known that audio shouldn't have a background track such as for speeches or monologues.
   */
  #[JsonProperty('drop_background_audio')]
  public ?bool $dropBackgroundAudio;

  /**
   * [BETA] Whether transcripts should have profanities censored with the words '[censored]'
   */
  #[JsonProperty('use_profanity_filter')]
  public ?bool $useProfanityFilter;

  /**
   * Whether to prepare dub for edits in dubbing studio or edits as a dubbing resource.
   */
  #[JsonProperty('dubbing_studio')]
  public ?bool $dubbingStudio;

  /**
   * Instead of using a voice clone in dubbing, use a similar voice from the ElevenLabs Voice Library. Voices used from the library will contribute towards a workspace's custom voices limit, and if there aren't enough available slots the dub will fail. Using this feature requires the caller to have the 'add_voice_from_voice_library' permission on their workspace to access new voices.
   */
  #[JsonProperty('disable_voice_cloning')]
  public ?bool $disableVoiceCloning;

  /**
   * @var ?value-of<\ElevenLabs\Dubbing\Types\DubRequestMode>
   * The mode in which to run this Dubbing job. Defaults to automatic, use manual if specifically providing a CSV transcript to use. Note that manual mode is experimental and production use is strongly discouraged.
   */
  #[JsonProperty('mode')]
  public ?string $mode;

  /**
   * Frames per second to use when parsing a CSV file for dubbing. If not provided, FPS will be inferred from timecodes.
   */
  #[JsonProperty('csv_fps')]
  public ?float $csvFps;

  /**
   * @param array{
   *   targetLang: ?string,
   *   file?: ?\ElevenLabs\Utils\File,
   *   csvFile?: ?\ElevenLabs\Utils\File,
   *   foregroundAudioFile?: ?\ElevenLabs\Utils\File,
   *   backgroundAudioFile?: ?\ElevenLabs\Utils\File,
   *   name?: ?string,
   *   sourceUrl?: ?string,
   *   sourceLang?: ?string,
   *   targetAccent?: ?string,
   *   numSpeakers?: ?int,
   *   watermark?: ?bool,
   *   startTime?: ?int,
   *   endTime?: ?int,
   *   highestResolution?: ?bool,
   *   dropBackgroundAudio?: ?bool,
   *   useProfanityFilter?: ?bool,
   *   dubbingStudio?: ?bool,
   *   disableVoiceCloning?: ?bool,
   *   mode?: ?value-of<\ElevenLabs\Dubbing\Types\DubRequestMode>,
   *   csvFps?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->file = $values['file'] ?? null;
    $this->csvFile = $values['csvFile'] ?? null;
    $this->foregroundAudioFile = $values['foregroundAudioFile'] ?? null;
    $this->backgroundAudioFile = $values['backgroundAudioFile'] ?? null;
    $this->name = $values['name'] ?? null;
    $this->sourceUrl = $values['sourceUrl'] ?? null;
    $this->sourceLang = $values['sourceLang'] ?? null;
    $this->targetLang = $values['targetLang'];
    $this->targetAccent = $values['targetAccent'] ?? null;
    $this->numSpeakers = $values['numSpeakers'] ?? null;
    $this->watermark = $values['watermark'] ?? null;
    $this->startTime = $values['startTime'] ?? null;
    $this->endTime = $values['endTime'] ?? null;
    $this->highestResolution = $values['highestResolution'] ?? null;
    $this->dropBackgroundAudio = $values['dropBackgroundAudio'] ?? null;
    $this->useProfanityFilter = $values['useProfanityFilter'] ?? null;
    $this->dubbingStudio = $values['dubbingStudio'] ?? null;
    $this->disableVoiceCloning = $values['disableVoiceCloning'] ?? null;
    $this->mode = $values['mode'] ?? null;
    $this->csvFps = $values['csvFps'] ?? null;

    $this->_dirtyFields = [
      'target_lang' => true
    ];
    if (array_key_exists('file', $values)) {
      $this->_dirtyFields['file'] = true;
    }
    if (array_key_exists('csvFile', $values)) {
      $this->_dirtyFields['csv_file'] = true;
    }
    if (array_key_exists('foregroundAudioFile', $values)) {
      $this->_dirtyFields['foreground_audio_file'] = true;
    }
    if (array_key_exists('backgroundAudioFile', $values)) {
      $this->_dirtyFields['background_audio_file'] = true;
    }
    if (array_key_exists('name', $values)) {
      $this->_dirtyFields['name'] = true;
    }
    if (array_key_exists('sourceUrl', $values)) {
      $this->_dirtyFields['source_url'] = true;
    }
    if (array_key_exists('sourceLang', $values)) {
      $this->_dirtyFields['source_lang'] = true;
    }
    if (array_key_exists('targetAccent', $values)) {
      $this->_dirtyFields['target_accent'] = true;
    }
    if (array_key_exists('numSpeakers', $values)) {
      $this->_dirtyFields['num_speakers'] = true;
    }
    if (array_key_exists('watermark', $values)) {
      $this->_dirtyFields['watermark'] = true;
    }
    if (array_key_exists('startTime', $values)) {
      $this->_dirtyFields['start_time'] = true;
    }
    if (array_key_exists('endTime', $values)) {
      $this->_dirtyFields['end_time'] = true;
    }
    if (array_key_exists('highestResolution', $values)) {
      $this->_dirtyFields['highest_resolution'] = true;
    }
    if (array_key_exists('dropBackgroundAudio', $values)) {
      $this->_dirtyFields['drop_background_audio'] = true;
    }
    if (array_key_exists('useProfanityFilter', $values)) {
      $this->_dirtyFields['use_profanity_filter'] = true;
    }
    if (array_key_exists('dubbingStudio', $values)) {
      $this->_dirtyFields['dubbing_studio'] = true;
    }
    if (array_key_exists('disableVoiceCloning', $values)) {
      $this->_dirtyFields['disable_voice_cloning'] = true;
    }
    if (array_key_exists('mode', $values)) {
      $this->_dirtyFields['mode'] = true;
    }
    if (array_key_exists('csvFps', $values)) {
      $this->_dirtyFields['csv_fps'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->file !== null) {
      $parts[] = $this->file->toMultipartFormDataPart('file')->toGuzzlePart();
    }

    if ($this->csvFile !== null) {
      $parts[] = $this->csvFile->toMultipartFormDataPart('csv_file')->toGuzzlePart();
    }

    if ($this->foregroundAudioFile !== null) {
      $parts[] = $this->foregroundAudioFile
        ->toMultipartFormDataPart('foreground_audio_file')
        ->toGuzzlePart();
    }

    if ($this->backgroundAudioFile !== null) {
      $parts[] = $this->backgroundAudioFile
        ->toMultipartFormDataPart('background_audio_file')
        ->toGuzzlePart();
    }

    if ($this->name !== null) {
      $parts[] = [
        'name' => 'name',
        'contents' => $this->name
      ];
    }

    if ($this->sourceUrl !== null) {
      $parts[] = [
        'name' => 'source_url',
        'contents' => $this->sourceUrl
      ];
    }

    if ($this->sourceLang !== null) {
      $parts[] = [
        'name' => 'source_lang',
        'contents' => $this->sourceLang
      ];
    }

    $parts[] = [
      'name' => 'target_lang',
      'contents' => $this->targetLang
    ];

    if ($this->targetAccent !== null) {
      $parts[] = [
        'name' => 'target_accent',
        'contents' => $this->targetAccent
      ];
    }

    if ($this->numSpeakers !== null) {
      $parts[] = [
        'name' => 'num_speakers',
        'contents' => (string) $this->numSpeakers
      ];
    }

    if ($this->watermark !== null) {
      $parts[] = [
        'name' => 'watermark',
        'contents' => $this->watermark ? 'true' : 'false'
      ];
    }

    if ($this->startTime !== null) {
      $parts[] = [
        'name' => 'start_time',
        'contents' => (string) $this->startTime
      ];
    }

    if ($this->endTime !== null) {
      $parts[] = [
        'name' => 'end_time',
        'contents' => (string) $this->endTime
      ];
    }

    if ($this->highestResolution !== null) {
      $parts[] = [
        'name' => 'highest_resolution',
        'contents' => $this->highestResolution ? 'true' : 'false'
      ];
    }

    if ($this->dropBackgroundAudio !== null) {
      $parts[] = [
        'name' => 'drop_background_audio',
        'contents' => $this->dropBackgroundAudio ? 'true' : 'false'
      ];
    }

    if ($this->useProfanityFilter !== null) {
      $parts[] = [
        'name' => 'use_profanity_filter',
        'contents' => $this->useProfanityFilter ? 'true' : 'false'
      ];
    }

    if ($this->dubbingStudio !== null) {
      $parts[] = [
        'name' => 'dubbing_studio',
        'contents' => $this->dubbingStudio ? 'true' : 'false'
      ];
    }

    if ($this->disableVoiceCloning !== null) {
      $parts[] = [
        'name' => 'disable_voice_cloning',
        'contents' => $this->disableVoiceCloning ? 'true' : 'false'
      ];
    }

    if ($this->mode !== null) {
      $parts[] = [
        'name' => 'mode',
        'contents' => $this->mode
      ];
    }

    if ($this->csvFps !== null) {
      $parts[] = [
        'name' => 'csv_fps',
        'contents' => (string) $this->csvFps
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SessionStartedConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('sample_rate', required: true)]
  public int $sampleRate;

  /**
   * @var value-of<\ElevenLabs\Types\SessionStartedConfigAudioFormat>
   */
  #[JsonProperty('audio_format', required: true)]
  public string $audioFormat;

  #[JsonProperty('language_code', required: true)]
  public ?string $languageCode;

  /**
   * @var string[]|null
   */
  #[JsonProperty('secondary_languages'), ArrayType(['string'])]
  public ?array $secondaryLanguages;

  /**
   * @var ?value-of<\ElevenLabs\Types\SessionStartedConfigTimestampsGranularity>
   */
  #[JsonProperty('timestamps_granularity')]
  public ?string $timestampsGranularity;

  #[JsonProperty('vad_commit_strategy')]
  public ?bool $vadCommitStrategy;

  #[JsonProperty('vad_silence_threshold_secs')]
  public ?float $vadSilenceThresholdSecs;

  #[JsonProperty('vad_threshold')]
  public ?float $vadThreshold;

  #[JsonProperty('min_speech_duration_ms')]
  public ?int $minSpeechDurationMs;

  #[JsonProperty('min_silence_duration_ms')]
  public ?int $minSilenceDurationMs;

  #[JsonProperty('max_tokens_to_recompute')]
  public ?int $maxTokensToRecompute;

  /**
   * @var ?value-of<\ElevenLabs\Types\SessionStartedConfigModelId>
   */
  #[JsonProperty('model_id')]
  public ?string $modelId;

  #[JsonProperty('disable_logging')]
  public ?bool $disableLogging;

  #[JsonProperty('include_timestamps')]
  public ?bool $includeTimestamps;

  #[JsonProperty('include_language_detection')]
  public ?bool $includeLanguageDetection;

  #[JsonProperty('filter_background_audio')]
  public ?bool $filterBackgroundAudio;

  /**
   * @var string[]|null
   */
  #[JsonProperty('keyterms'), ArrayType(['string'])]
  public ?array $keyterms;

  #[JsonProperty('no_verbatim')]
  public ?bool $noVerbatim;

  /**
   * @var string[]|null
   */
  #[JsonProperty('entity_detection'), ArrayType(['string'])]
  public ?array $entityDetection;

  /**
   * @var string[]|null
   */
  #[JsonProperty('entity_redaction'), ArrayType(['string'])]
  public ?array $entityRedaction;

  #[JsonProperty('entity_redaction_mode')]
  public ?string $entityRedactionMode;

  #[JsonProperty('keepalive_interval_ms')]
  public ?int $keepaliveIntervalMs;

  /**
   * @param array{
   *   sampleRate: int,
   *   audioFormat: value-of<\ElevenLabs\Types\SessionStartedConfigAudioFormat>,
   *   languageCode: ?string,
   *   secondaryLanguages?: string[]|null,
   *   timestampsGranularity?: ?value-of<\ElevenLabs\Types\SessionStartedConfigTimestampsGranularity>,
   *   vadCommitStrategy?: ?bool,
   *   vadSilenceThresholdSecs?: ?float,
   *   vadThreshold?: ?float,
   *   minSpeechDurationMs?: ?int,
   *   minSilenceDurationMs?: ?int,
   *   maxTokensToRecompute?: ?int,
   *   modelId?: ?value-of<\ElevenLabs\Types\SessionStartedConfigModelId>,
   *   disableLogging?: ?bool,
   *   includeTimestamps?: ?bool,
   *   includeLanguageDetection?: ?bool,
   *   filterBackgroundAudio?: ?bool,
   *   keyterms?: string[]|null,
   *   noVerbatim?: ?bool,
   *   entityDetection?: string[]|null,
   *   entityRedaction?: string[]|null,
   *   entityRedactionMode?: ?string,
   *   keepaliveIntervalMs?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->sampleRate = $values['sampleRate'];
    $this->audioFormat = $values['audioFormat'];
    $this->languageCode = $values['languageCode'];
    $this->secondaryLanguages = $values['secondaryLanguages'] ?? null;
    $this->timestampsGranularity = $values['timestampsGranularity'] ?? null;
    $this->vadCommitStrategy = $values['vadCommitStrategy'] ?? null;
    $this->vadSilenceThresholdSecs = $values['vadSilenceThresholdSecs'] ?? null;
    $this->vadThreshold = $values['vadThreshold'] ?? null;
    $this->minSpeechDurationMs = $values['minSpeechDurationMs'] ?? null;
    $this->minSilenceDurationMs = $values['minSilenceDurationMs'] ?? null;
    $this->maxTokensToRecompute = $values['maxTokensToRecompute'] ?? null;
    $this->modelId = $values['modelId'] ?? null;
    $this->disableLogging = $values['disableLogging'] ?? null;
    $this->includeTimestamps = $values['includeTimestamps'] ?? null;
    $this->includeLanguageDetection = $values['includeLanguageDetection'] ?? null;
    $this->filterBackgroundAudio = $values['filterBackgroundAudio'] ?? null;
    $this->keyterms = $values['keyterms'] ?? null;
    $this->noVerbatim = $values['noVerbatim'] ?? null;
    $this->entityDetection = $values['entityDetection'] ?? null;
    $this->entityRedaction = $values['entityRedaction'] ?? null;
    $this->entityRedactionMode = $values['entityRedactionMode'] ?? null;
    $this->keepaliveIntervalMs = $values['keepaliveIntervalMs'] ?? null;

    $this->_dirtyFields = [
      'sample_rate' => true,
      'audio_format' => true,
      'language_code' => true
    ];
    if (array_key_exists('secondaryLanguages', $values)) {
      $this->_dirtyFields['secondary_languages'] = true;
    }
    if (array_key_exists('timestampsGranularity', $values)) {
      $this->_dirtyFields['timestamps_granularity'] = true;
    }
    if (array_key_exists('vadCommitStrategy', $values)) {
      $this->_dirtyFields['vad_commit_strategy'] = true;
    }
    if (array_key_exists('vadSilenceThresholdSecs', $values)) {
      $this->_dirtyFields['vad_silence_threshold_secs'] = true;
    }
    if (array_key_exists('vadThreshold', $values)) {
      $this->_dirtyFields['vad_threshold'] = true;
    }
    if (array_key_exists('minSpeechDurationMs', $values)) {
      $this->_dirtyFields['min_speech_duration_ms'] = true;
    }
    if (array_key_exists('minSilenceDurationMs', $values)) {
      $this->_dirtyFields['min_silence_duration_ms'] = true;
    }
    if (array_key_exists('maxTokensToRecompute', $values)) {
      $this->_dirtyFields['max_tokens_to_recompute'] = true;
    }
    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
    }
    if (array_key_exists('disableLogging', $values)) {
      $this->_dirtyFields['disable_logging'] = true;
    }
    if (array_key_exists('includeTimestamps', $values)) {
      $this->_dirtyFields['include_timestamps'] = true;
    }
    if (array_key_exists('includeLanguageDetection', $values)) {
      $this->_dirtyFields['include_language_detection'] = true;
    }
    if (array_key_exists('filterBackgroundAudio', $values)) {
      $this->_dirtyFields['filter_background_audio'] = true;
    }
    if (array_key_exists('keyterms', $values)) {
      $this->_dirtyFields['keyterms'] = true;
    }
    if (array_key_exists('noVerbatim', $values)) {
      $this->_dirtyFields['no_verbatim'] = true;
    }
    if (array_key_exists('entityDetection', $values)) {
      $this->_dirtyFields['entity_detection'] = true;
    }
    if (array_key_exists('entityRedaction', $values)) {
      $this->_dirtyFields['entity_redaction'] = true;
    }
    if (array_key_exists('entityRedactionMode', $values)) {
      $this->_dirtyFields['entity_redaction_mode'] = true;
    }
    if (array_key_exists('keepaliveIntervalMs', $values)) {
      $this->_dirtyFields['keepalive_interval_ms'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'sample_rate',
      'contents' => (string) $this->sampleRate
    ];

    $parts[] = [
      'name' => 'audio_format',
      'contents' => $this->audioFormat
    ];

    $parts[] = [
      'name' => 'language_code',
      'contents' => $this->languageCode
    ];

    if ($this->secondaryLanguages !== null) {
      foreach ($this->secondaryLanguages ?? [] as $item) {
        $parts[] = [
          'name' => 'secondary_languages',
          'contents' => $item
        ];
      }
    }

    if ($this->timestampsGranularity !== null) {
      $parts[] = [
        'name' => 'timestamps_granularity',
        'contents' => $this->timestampsGranularity
      ];
    }

    if ($this->vadCommitStrategy !== null) {
      $parts[] = [
        'name' => 'vad_commit_strategy',
        'contents' => $this->vadCommitStrategy ? 'true' : 'false'
      ];
    }

    if ($this->vadSilenceThresholdSecs !== null) {
      $parts[] = [
        'name' => 'vad_silence_threshold_secs',
        'contents' => (string) $this->vadSilenceThresholdSecs
      ];
    }

    if ($this->vadThreshold !== null) {
      $parts[] = [
        'name' => 'vad_threshold',
        'contents' => (string) $this->vadThreshold
      ];
    }

    if ($this->minSpeechDurationMs !== null) {
      $parts[] = [
        'name' => 'min_speech_duration_ms',
        'contents' => (string) $this->minSpeechDurationMs
      ];
    }

    if ($this->minSilenceDurationMs !== null) {
      $parts[] = [
        'name' => 'min_silence_duration_ms',
        'contents' => (string) $this->minSilenceDurationMs
      ];
    }

    if ($this->maxTokensToRecompute !== null) {
      $parts[] = [
        'name' => 'max_tokens_to_recompute',
        'contents' => (string) $this->maxTokensToRecompute
      ];
    }

    if ($this->modelId !== null) {
      $parts[] = [
        'name' => 'model_id',
        'contents' => $this->modelId
      ];
    }

    if ($this->disableLogging !== null) {
      $parts[] = [
        'name' => 'disable_logging',
        'contents' => $this->disableLogging ? 'true' : 'false'
      ];
    }

    if ($this->includeTimestamps !== null) {
      $parts[] = [
        'name' => 'include_timestamps',
        'contents' => $this->includeTimestamps ? 'true' : 'false'
      ];
    }

    if ($this->includeLanguageDetection !== null) {
      $parts[] = [
        'name' => 'include_language_detection',
        'contents' => $this->includeLanguageDetection ? 'true' : 'false'
      ];
    }

    if ($this->filterBackgroundAudio !== null) {
      $parts[] = [
        'name' => 'filter_background_audio',
        'contents' => $this->filterBackgroundAudio ? 'true' : 'false'
      ];
    }

    if ($this->keyterms !== null) {
      foreach ($this->keyterms ?? [] as $item) {
        $parts[] = [
          'name' => 'keyterms',
          'contents' => $item
        ];
      }
    }

    if ($this->noVerbatim !== null) {
      $parts[] = [
        'name' => 'no_verbatim',
        'contents' => $this->noVerbatim ? 'true' : 'false'
      ];
    }

    if ($this->entityDetection !== null) {
      foreach ($this->entityDetection ?? [] as $item) {
        $parts[] = [
          'name' => 'entity_detection',
          'contents' => $item
        ];
      }
    }

    if ($this->entityRedaction !== null) {
      foreach ($this->entityRedaction ?? [] as $item) {
        $parts[] = [
          'name' => 'entity_redaction',
          'contents' => $item
        ];
      }
    }

    if ($this->entityRedactionMode !== null) {
      $parts[] = [
        'name' => 'entity_redaction_mode',
        'contents' => $this->entityRedactionMode
      ];
    }

    if ($this->keepaliveIntervalMs !== null) {
      $parts[] = [
        'name' => 'keepalive_interval_ms',
        'contents' => (string) $this->keepaliveIntervalMs
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

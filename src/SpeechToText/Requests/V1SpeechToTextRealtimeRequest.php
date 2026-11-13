<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechToText\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\SpeechToTextRealtimeCommitStrategy;
use ElevenLabs\Types\SpeechToTextRealtimeEntityRedactionMode;
use ElevenLabs\Types\SpeechToTextRealtimeModelId;

class V1SpeechToTextRealtimeRequest extends JsonSerializableType
{
  /**
   * @var value-of<SpeechToTextRealtimeModelId> $modelId
   */
  public string $modelId;

  /**
   * @var ?string $token
   */
  public ?string $token;

  /**
   * @var ?string $audioFormat
   */
  public ?string $audioFormat;

  /**
   * @var ?string $languageCode
   */
  public ?string $languageCode;

  /**
   * @var ?array $secondaryLanguages
   */
  public ?array $secondaryLanguages;

  /**
   * @var ?value-of<SpeechToTextRealtimeCommitStrategy> $commitStrategy
   */
  public ?string $commitStrategy;

  /**
   * @var ?float $vadThreshold
   */
  public ?float $vadThreshold;

  /**
   * @var ?float $vadSilenceThresholdSecs
   */
  public ?float $vadSilenceThresholdSecs;

  /**
   * @var ?int $minSpeechDurationMs
   */
  public ?int $minSpeechDurationMs;

  /**
   * @var ?int $minSilenceDurationMs
   */
  public ?int $minSilenceDurationMs;

  /**
   * @var ?bool $includeTimestamps
   */
  public ?bool $includeTimestamps;

  /**
   * @var ?bool $includeLanguageDetection
   */
  public ?bool $includeLanguageDetection;

  /**
   * @var ?array $keyterms
   */
  public ?array $keyterms;

  /**
   * @var ?bool $noVerbatim
   */
  public ?bool $noVerbatim;

  /**
   * @var ?bool $multilangMode
   */
  public ?bool $multilangMode;

  /**
   * @var ?bool $diarize
   */
  public ?bool $diarize;

  /**
   * @var string|array|null $entityDetection
   */
  public string|array|null $entityDetection;

  /**
   * @var string|array|null $entityRedaction
   */
  public string|array|null $entityRedaction;

  /**
   * @var ?value-of<SpeechToTextRealtimeEntityRedactionMode> $entityRedactionMode
   */
  public ?string $entityRedactionMode;

  /**
   * @var ?string $transcriptEdit
   */
  public ?string $transcriptEdit;

  /**
   * @var ?bool $filterBackgroundAudio
   */
  public ?bool $filterBackgroundAudio;

  /**
   * @var ?int $keepaliveIntervalMs
   */
  public ?int $keepaliveIntervalMs;

  /**
   * @var ?bool $enableLogging
   */
  public ?bool $enableLogging;

  /**
   * @param array{
   *   modelId: value-of<SpeechToTextRealtimeModelId>,
   *   token?: ?string,
   *   audioFormat?: ?string,
   *   languageCode?: ?string,
   *   secondaryLanguages?: ?array,
   *   commitStrategy?: ?value-of<SpeechToTextRealtimeCommitStrategy>,
   *   vadThreshold?: ?float,
   *   vadSilenceThresholdSecs?: ?float,
   *   minSpeechDurationMs?: ?int,
   *   minSilenceDurationMs?: ?int,
   *   includeTimestamps?: ?bool,
   *   includeLanguageDetection?: ?bool,
   *   keyterms?: ?array,
   *   noVerbatim?: ?bool,
   *   multilangMode?: ?bool,
   *   diarize?: ?bool,
   *   entityDetection?: string|array|null,
   *   entityRedaction?: string|array|null,
   *   entityRedactionMode?: ?value-of<SpeechToTextRealtimeEntityRedactionMode>,
   *   transcriptEdit?: ?string,
   *   filterBackgroundAudio?: ?bool,
   *   keepaliveIntervalMs?: ?int,
   *   enableLogging?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->modelId = $values['modelId'];
    $this->token = $values['token'] ?? null;
    $this->audioFormat = $values['audioFormat'] ?? null;
    $this->languageCode = $values['languageCode'] ?? null;
    $this->secondaryLanguages = $values['secondaryLanguages'] ?? null;
    $this->commitStrategy = $values['commitStrategy'] ?? null;
    $this->vadThreshold = $values['vadThreshold'] ?? null;
    $this->vadSilenceThresholdSecs = $values['vadSilenceThresholdSecs'] ?? null;
    $this->minSpeechDurationMs = $values['minSpeechDurationMs'] ?? null;
    $this->minSilenceDurationMs = $values['minSilenceDurationMs'] ?? null;
    $this->includeTimestamps = $values['includeTimestamps'] ?? null;
    $this->includeLanguageDetection = $values['includeLanguageDetection'] ?? null;
    $this->keyterms = $values['keyterms'] ?? null;
    $this->noVerbatim = $values['noVerbatim'] ?? null;
    $this->multilangMode = $values['multilangMode'] ?? null;
    $this->diarize = $values['diarize'] ?? null;
    $this->entityDetection = $values['entityDetection'] ?? null;
    $this->entityRedaction = $values['entityRedaction'] ?? null;
    $this->entityRedactionMode = $values['entityRedactionMode'] ?? null;
    $this->transcriptEdit = $values['transcriptEdit'] ?? null;
    $this->filterBackgroundAudio = $values['filterBackgroundAudio'] ?? null;
    $this->keepaliveIntervalMs = $values['keepaliveIntervalMs'] ?? null;
    $this->enableLogging = $values['enableLogging'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'modelId' => $data['model_id'],
      'token' => $data['token'] ?? null,
      'audioFormat' => $data['audio_format'] ?? null,
      'languageCode' => $data['language_code'] ?? null,
      'secondaryLanguages' => $data['secondary_languages'] ?? null,
      'commitStrategy' => $data['commit_strategy'] ?? null,
      'vadThreshold' => $data['vad_threshold'] ?? null,
      'vadSilenceThresholdSecs' => $data['vad_silence_threshold_secs'] ?? null,
      'minSpeechDurationMs' => $data['min_speech_duration_ms'] ?? null,
      'minSilenceDurationMs' => $data['min_silence_duration_ms'] ?? null,
      'includeTimestamps' => $data['include_timestamps'] ?? null,
      'includeLanguageDetection' => $data['include_language_detection'] ?? null,
      'keyterms' => $data['keyterms'] ?? null,
      'noVerbatim' => $data['no_verbatim'] ?? null,
      'multilangMode' => $data['multilang_mode'] ?? null,
      'diarize' => $data['diarize'] ?? null,
      'entityDetection' => $data['entity_detection'] ?? null,
      'entityRedaction' => $data['entity_redaction'] ?? null,
      'entityRedactionMode' => $data['entity_redaction_mode'] ?? null,
      'transcriptEdit' => $data['transcript_edit'] ?? null,
      'filterBackgroundAudio' => $data['filter_background_audio'] ?? null,
      'keepaliveIntervalMs' => $data['keepalive_interval_ms'] ?? null,
      'enableLogging' => $data['enable_logging'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    $result['model_id'] = $this->modelId;
    if ($this->token !== null) {
      $result['token'] = $this->token;
    }
    if ($this->audioFormat !== null) {
      $result['audio_format'] = $this->audioFormat;
    }
    if ($this->languageCode !== null) {
      $result['language_code'] = $this->languageCode;
    }
    if ($this->secondaryLanguages !== null) {
      $result['secondary_languages'] = $this->secondaryLanguages;
    }
    if ($this->commitStrategy !== null) {
      $result['commit_strategy'] = $this->commitStrategy;
    }
    if ($this->vadThreshold !== null) {
      $result['vad_threshold'] = $this->vadThreshold;
    }
    if ($this->vadSilenceThresholdSecs !== null) {
      $result['vad_silence_threshold_secs'] = $this->vadSilenceThresholdSecs;
    }
    if ($this->minSpeechDurationMs !== null) {
      $result['min_speech_duration_ms'] = $this->minSpeechDurationMs;
    }
    if ($this->minSilenceDurationMs !== null) {
      $result['min_silence_duration_ms'] = $this->minSilenceDurationMs;
    }
    if ($this->includeTimestamps !== null) {
      $result['include_timestamps'] = $this->includeTimestamps;
    }
    if ($this->includeLanguageDetection !== null) {
      $result['include_language_detection'] = $this->includeLanguageDetection;
    }
    if ($this->keyterms !== null) {
      $result['keyterms'] = $this->keyterms;
    }
    if ($this->noVerbatim !== null) {
      $result['no_verbatim'] = $this->noVerbatim;
    }
    if ($this->multilangMode !== null) {
      $result['multilang_mode'] = $this->multilangMode;
    }
    if ($this->diarize !== null) {
      $result['diarize'] = $this->diarize;
    }
    if ($this->entityDetection !== null) {
      $result['entity_detection'] = $this->entityDetection;
    }
    if ($this->entityRedaction !== null) {
      $result['entity_redaction'] = $this->entityRedaction;
    }
    if ($this->entityRedactionMode !== null) {
      $result['entity_redaction_mode'] = $this->entityRedactionMode;
    }
    if ($this->transcriptEdit !== null) {
      $result['transcript_edit'] = $this->transcriptEdit;
    }
    if ($this->filterBackgroundAudio !== null) {
      $result['filter_background_audio'] = $this->filterBackgroundAudio;
    }
    if ($this->keepaliveIntervalMs !== null) {
      $result['keepalive_interval_ms'] = $this->keepaliveIntervalMs;
    }
    if ($this->enableLogging !== null) {
      $result['enable_logging'] = $this->enableLogging;
    }
    return $result;
  }
}

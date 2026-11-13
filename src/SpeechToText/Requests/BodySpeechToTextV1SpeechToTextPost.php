<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechToText\Requests;

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
class BodySpeechToTextV1SpeechToTextPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * A single-use authentication token created via POST /v1/single-use-token/batch_scribe. This token can only be used once and expires after 15 minutes. Alternative to API key or bearer token authentication for frontend clients.
   */
  public ?string $token;

  /**
   * When enable_logging is set to false zero retention mode will be used for the request. This will mean log and transcript storage features are unavailable for this request. Zero retention mode may only be used by enterprise customers.
   */
  public ?bool $enableLogging;

  /**
   * The ID of the model to use for transcription.
   */
  #[JsonProperty('model_id', required: true)]
  public string $modelId;

  /**
   * @var ?\ElevenLabs\Utils\File
   * The file to transcribe (100ms minimum audio length). All major audio and video formats are supported. Exactly one of the file or cloud_storage_url parameters must be provided. The file size must be less than 5.0GB.
   */
  #[JsonProperty('file')]
  public ?\ElevenLabs\Utils\File $file;

  /**
   * An ISO-639-1 or ISO-639-3 language_code corresponding to the language of the audio file. Can sometimes improve transcription performance if known beforehand. Defaults to null, in this case the language is predicted automatically.
   */
  #[JsonProperty('language_code')]
  public ?string $languageCode;

  /**
   * @var string[]|null
   * Additional ISO-639-1 or ISO-639-3 language codes that may be present in the audio, alongside language_code. Improves transcription accuracy for multilingual audio. Supported by scribe_v3.
   */
  #[JsonProperty('secondary_language_codes'), ArrayType(['string'])]
  public ?array $secondaryLanguageCodes;

  /**
   * @var ?value-of<\ElevenLabs\SpeechToText\Types\ConvertSpeechToTextRequestNumbersFormat>
   * How numbers are formatted in the transcript: 'digits' (e.g. '42') or 'words' (e.g. 'forty-two'). Supported by scribe_v3.
   */
  #[JsonProperty('numbers_format')]
  public ?string $numbersFormat;

  /**
   * Natural-language instruction applied to the final transcript (max 2000 characters). The edited text is returned in 'edited_transcript' alongside the original transcript. Cannot be combined with entity_detection, entity_redaction or use_multi_channel. Usage of this parameter will incur an additional 30% surcharge on the base transcription cost, billed for at least 10 seconds of audio.
   */
  #[JsonProperty('transcript_edit')]
  public ?string $transcriptEdit;

  /**
   * Whether to tag audio events like (laughter), (footsteps), etc. in the transcription.
   */
  #[JsonProperty('tag_audio_events')]
  public ?bool $tagAudioEvents;

  /**
   * The maximum amount of speakers talking in the uploaded file. Can help with predicting who speaks when. The maximum amount of speakers that can be predicted is 32. Defaults to null, in this case the amount of speakers is set to the maximum value the model supports.
   */
  #[JsonProperty('num_speakers')]
  public ?int $numSpeakers;

  /**
   * @var ?value-of<\ElevenLabs\SpeechToText\Types\ConvertSpeechToTextRequestTimestampsGranularity>
   * The granularity of the timestamps in the transcription. 'word' provides word-level timestamps and 'character' provides character-level timestamps per word.
   */
  #[JsonProperty('timestamps_granularity')]
  public ?string $timestampsGranularity;

  /**
   * Whether to annotate which speaker is currently talking in the uploaded file.
   */
  #[JsonProperty('diarize')]
  public ?bool $diarize;

  /**
   * Diarization threshold to apply during speaker diarization. A higher value means there will be a lower chance of one speaker being diarized as two different speakers but also a higher chance of two different speakers being diarized as one speaker (less total speakers predicted). A low value means there will be a higher chance of one speaker being diarized as two different speakers but also a lower chance of two different speakers being diarized as one speaker (more total speakers predicted). Can only be set when diarize=True and num_speakers=None. Defaults to None, in which case we will choose a threshold based on the model_id (0.22 usually).
   */
  #[JsonProperty('diarization_threshold')]
  public ?float $diarizationThreshold;

  /**
   * @var \ElevenLabs\Types\ExportOptions[]|null
   */
  #[JsonProperty('additional_formats'), ArrayType([\ElevenLabs\Types\ExportOptions::class])]
  public ?array $additionalFormats;

  /**
   * @var ?value-of<\ElevenLabs\SpeechToText\Types\ConvertSpeechToTextRequestFileFormat>
   * The format of input audio. Options are 'pcm_s16le_16' or 'other' For `pcm_s16le_16`, the input audio must be 16-bit PCM at a 16kHz sample rate, single channel (mono), and little-endian byte order. Latency will be lower than with passing an encoded waveform.
   */
  #[JsonProperty('file_format')]
  public ?string $fileFormat;

  /**
   * The URL of an audio or video file to transcribe. Supports hosted video or audio files, YouTube video URLs, TikTok video URLs, and other video hosting services.
   */
  #[JsonProperty('source_url')]
  public ?string $sourceUrl;

  /**
   * Whether to send the transcription result to configured speech-to-text webhooks.  If set the request will return early without the transcription, which will be delivered later via webhook.
   */
  #[JsonProperty('webhook')]
  public ?bool $webhook;

  /**
   * Optional specific webhook ID to send the transcription result to. Only valid when webhook is set to true. If not provided, transcription will be sent to all configured speech-to-text webhooks.
   */
  #[JsonProperty('webhook_id')]
  public ?string $webhookId;

  /**
   * Controls the randomness of the transcription output. Accepts values between 0.0 and 2.0, where higher values result in more diverse and less deterministic results. If omitted, we will use a temperature based on the model you selected which is usually 0.
   */
  #[JsonProperty('temperature')]
  public ?float $temperature;

  /**
   * If specified, our system will make a best effort to sample deterministically, such that repeated requests with the same seed and parameters should return the same result. Determinism is not guaranteed. Must be an integer between 0 and 2147483647.
   */
  #[JsonProperty('seed')]
  public ?int $seed;

  /**
   * Whether the audio file contains multiple channels where each channel contains a single speaker. When enabled, each channel is transcribed independently. By default a separate transcript is returned per channel; set multichannel_output_style='combined' to instead receive a single transcript with all channels merged and sorted by time. Each word in the response includes a 'channel_index' field indicating which channel it was spoken on. A maximum of 5 channels is supported. Each channel is billed independently at the full audio duration, so cost scales linearly with the number of channels.
   */
  #[JsonProperty('use_multi_channel')]
  public ?bool $useMultiChannel;

  /**
   * @var ?value-of<\ElevenLabs\SpeechToText\Types\ConvertSpeechToTextRequestMultichannelOutputStyle>
   * Controls the response shape when use_multi_channel is enabled. 'separate' (default) returns one transcript per channel under 'transcripts'. 'combined' merges all channels into a single transcript whose words are sorted by start time, each carrying a 'channel_index' - matching the single-channel response shape. 'combined' requires timestamps (timestamps_granularity must not be 'none') and does not support entity detection or redaction.
   */
  #[JsonProperty('multichannel_output_style')]
  public ?string $multichannelOutputStyle;

  /**
   * Optional metadata to be included in the webhook response. This should be a JSON string representing an object with a maximum depth of 2 levels and maximum size of 16KB. Useful for tracking internal IDs, job references, or other contextual information.
   */
  #[JsonProperty('webhook_metadata')]
  public string|array|null $webhookMetadata;

  /**
   * Detect entities in the transcript. Can be 'all' to detect all entities, a single entity type or category string, or a list of entity types/categories. Categories include 'pii', 'phi', 'pci', 'other', 'offensive_language'. When enabled, detected entities will be returned in the 'entities' field with their text, type, and character positions.
   */
  #[JsonProperty('entity_detection')]
  public string|array|null $entityDetection;

  /**
   * If true, the transcription will not have any filler words, false starts and non-speech sounds. Supported by scribe_v2, scribe_v2_medical and scribe_v3.
   */
  #[JsonProperty('no_verbatim')]
  public ?bool $noVerbatim;

  /**
   * Whether to use the speaker library for identifying known speakers during diarization. When enabled and diarize is true, detected speakers will be matched against registered speakers in the workspace's speaker library.
   */
  #[JsonProperty('use_speaker_library')]
  public ?bool $useSpeakerLibrary;

  /**
   * Whether to detect speaker roles (agent vs customer). Requires diarize=true. Cannot be used with use_multi_channel=true. When enabled, speaker_id values will be 'agent' and 'customer' instead of 'speaker_0', 'speaker_1', etc. Usage incurs an additional 10% surcharge on base transcription cost.
   */
  #[JsonProperty('detect_speaker_roles')]
  public ?bool $detectSpeakerRoles;

  /**
   * Redact entities from the transcript text. Accepts the same format as entity_detection: 'all', a category ('pii', 'phi'), or specific entity types. Must be a subset of entity_detection. When redaction is enabled, the entities field will not be returned.
   */
  #[JsonProperty('entity_redaction')]
  public string|array|null $entityRedaction;

  /**
   * How to format redacted entities. 'redacted' replaces with {REDACTED}, 'entity_type' replaces with {ENTITY_TYPE}, 'enumerated_entity_type' replaces with {ENTITY_TYPE_N} where N enumerates each occurrence. Only used when entity_redaction is set.
   */
  #[JsonProperty('entity_redaction_mode')]
  public ?string $entityRedactionMode;

  /**
   * @var string[]|null
   * A list of keyterms to bias the transcription towards.           The keyterms are words or phrases you want the model to recognise more accurately.           The number of keyterms cannot exceed 1000.           The length of each keyterm must be at most 50 characters.           Keyterms can contain at most 5 words (after normalisation).           For example ["hello", "world", "technical term"].           The following characters are not supported: `<`, `>`, `{`, `}`, `[`, `]`, `\`.           Usage of this parameter will incur an additional 20% surcharge on the base transcription cost.           When more than 100 keyterms are provided, a minimum billable duration of 20 seconds applies per request.
   */
  #[JsonProperty('keyterms'), ArrayType(['string'])]
  public ?array $keyterms;

  /**
   * @param array{
   *   modelId: string,
   *   token?: ?string,
   *   enableLogging?: ?bool,
   *   file?: ?\ElevenLabs\Utils\File,
   *   languageCode?: ?string,
   *   secondaryLanguageCodes?: string[]|null,
   *   numbersFormat?: ?value-of<\ElevenLabs\SpeechToText\Types\ConvertSpeechToTextRequestNumbersFormat>,
   *   transcriptEdit?: ?string,
   *   tagAudioEvents?: ?bool,
   *   numSpeakers?: ?int,
   *   timestampsGranularity?: ?value-of<\ElevenLabs\SpeechToText\Types\ConvertSpeechToTextRequestTimestampsGranularity>,
   *   diarize?: ?bool,
   *   diarizationThreshold?: ?float,
   *   additionalFormats?: \ElevenLabs\Types\ExportOptions[]|null,
   *   fileFormat?: ?value-of<\ElevenLabs\SpeechToText\Types\ConvertSpeechToTextRequestFileFormat>,
   *   sourceUrl?: ?string,
   *   webhook?: ?bool,
   *   webhookId?: ?string,
   *   temperature?: ?float,
   *   seed?: ?int,
   *   useMultiChannel?: ?bool,
   *   multichannelOutputStyle?: ?value-of<\ElevenLabs\SpeechToText\Types\ConvertSpeechToTextRequestMultichannelOutputStyle>,
   *   webhookMetadata?: string|array|null,
   *   entityDetection?: string|array|null,
   *   noVerbatim?: ?bool,
   *   useSpeakerLibrary?: ?bool,
   *   detectSpeakerRoles?: ?bool,
   *   entityRedaction?: string|array|null,
   *   entityRedactionMode?: ?string,
   *   keyterms?: string[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->token = $values['token'] ?? null;
    $this->enableLogging = $values['enableLogging'] ?? null;
    $this->modelId = $values['modelId'];
    $this->file = $values['file'] ?? null;
    $this->languageCode = $values['languageCode'] ?? null;
    $this->secondaryLanguageCodes = $values['secondaryLanguageCodes'] ?? null;
    $this->numbersFormat = $values['numbersFormat'] ?? null;
    $this->transcriptEdit = $values['transcriptEdit'] ?? null;
    $this->tagAudioEvents = $values['tagAudioEvents'] ?? null;
    $this->numSpeakers = $values['numSpeakers'] ?? null;
    $this->timestampsGranularity = $values['timestampsGranularity'] ?? null;
    $this->diarize = $values['diarize'] ?? null;
    $this->diarizationThreshold = $values['diarizationThreshold'] ?? null;
    $this->additionalFormats = $values['additionalFormats'] ?? null;
    $this->fileFormat = $values['fileFormat'] ?? null;
    $this->sourceUrl = $values['sourceUrl'] ?? null;
    $this->webhook = $values['webhook'] ?? null;
    $this->webhookId = $values['webhookId'] ?? null;
    $this->temperature = $values['temperature'] ?? null;
    $this->seed = $values['seed'] ?? null;
    $this->useMultiChannel = $values['useMultiChannel'] ?? null;
    $this->multichannelOutputStyle = $values['multichannelOutputStyle'] ?? null;
    $this->webhookMetadata = $values['webhookMetadata'] ?? null;
    $this->entityDetection = $values['entityDetection'] ?? null;
    $this->noVerbatim = $values['noVerbatim'] ?? null;
    $this->useSpeakerLibrary = $values['useSpeakerLibrary'] ?? null;
    $this->detectSpeakerRoles = $values['detectSpeakerRoles'] ?? null;
    $this->entityRedaction = $values['entityRedaction'] ?? null;
    $this->entityRedactionMode = $values['entityRedactionMode'] ?? null;
    $this->keyterms = $values['keyterms'] ?? null;

    $this->_dirtyFields = [
      'model_id' => true
    ];
    if (array_key_exists('file', $values)) {
      $this->_dirtyFields['file'] = true;
    }
    if (array_key_exists('languageCode', $values)) {
      $this->_dirtyFields['language_code'] = true;
    }
    if (array_key_exists('secondaryLanguageCodes', $values)) {
      $this->_dirtyFields['secondary_language_codes'] = true;
    }
    if (array_key_exists('numbersFormat', $values)) {
      $this->_dirtyFields['numbers_format'] = true;
    }
    if (array_key_exists('transcriptEdit', $values)) {
      $this->_dirtyFields['transcript_edit'] = true;
    }
    if (array_key_exists('tagAudioEvents', $values)) {
      $this->_dirtyFields['tag_audio_events'] = true;
    }
    if (array_key_exists('numSpeakers', $values)) {
      $this->_dirtyFields['num_speakers'] = true;
    }
    if (array_key_exists('timestampsGranularity', $values)) {
      $this->_dirtyFields['timestamps_granularity'] = true;
    }
    if (array_key_exists('diarize', $values)) {
      $this->_dirtyFields['diarize'] = true;
    }
    if (array_key_exists('diarizationThreshold', $values)) {
      $this->_dirtyFields['diarization_threshold'] = true;
    }
    if (array_key_exists('additionalFormats', $values)) {
      $this->_dirtyFields['additional_formats'] = true;
    }
    if (array_key_exists('fileFormat', $values)) {
      $this->_dirtyFields['file_format'] = true;
    }
    if (array_key_exists('sourceUrl', $values)) {
      $this->_dirtyFields['source_url'] = true;
    }
    if (array_key_exists('webhook', $values)) {
      $this->_dirtyFields['webhook'] = true;
    }
    if (array_key_exists('webhookId', $values)) {
      $this->_dirtyFields['webhook_id'] = true;
    }
    if (array_key_exists('temperature', $values)) {
      $this->_dirtyFields['temperature'] = true;
    }
    if (array_key_exists('seed', $values)) {
      $this->_dirtyFields['seed'] = true;
    }
    if (array_key_exists('useMultiChannel', $values)) {
      $this->_dirtyFields['use_multi_channel'] = true;
    }
    if (array_key_exists('multichannelOutputStyle', $values)) {
      $this->_dirtyFields['multichannel_output_style'] = true;
    }
    if (array_key_exists('webhookMetadata', $values)) {
      $this->_dirtyFields['webhook_metadata'] = true;
    }
    if (array_key_exists('entityDetection', $values)) {
      $this->_dirtyFields['entity_detection'] = true;
    }
    if (array_key_exists('noVerbatim', $values)) {
      $this->_dirtyFields['no_verbatim'] = true;
    }
    if (array_key_exists('useSpeakerLibrary', $values)) {
      $this->_dirtyFields['use_speaker_library'] = true;
    }
    if (array_key_exists('detectSpeakerRoles', $values)) {
      $this->_dirtyFields['detect_speaker_roles'] = true;
    }
    if (array_key_exists('entityRedaction', $values)) {
      $this->_dirtyFields['entity_redaction'] = true;
    }
    if (array_key_exists('entityRedactionMode', $values)) {
      $this->_dirtyFields['entity_redaction_mode'] = true;
    }
    if (array_key_exists('keyterms', $values)) {
      $this->_dirtyFields['keyterms'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'model_id',
      'contents' => $this->modelId
    ];

    if ($this->file !== null) {
      $parts[] = $this->file->toMultipartFormDataPart('file')->toGuzzlePart();
    }

    if ($this->languageCode !== null) {
      $parts[] = [
        'name' => 'language_code',
        'contents' => $this->languageCode
      ];
    }

    if ($this->secondaryLanguageCodes !== null) {
      foreach ($this->secondaryLanguageCodes ?? [] as $item) {
        $parts[] = [
          'name' => 'secondary_language_codes',
          'contents' => $item
        ];
      }
    }

    if ($this->numbersFormat !== null) {
      $parts[] = [
        'name' => 'numbers_format',
        'contents' => $this->numbersFormat
      ];
    }

    if ($this->transcriptEdit !== null) {
      $parts[] = [
        'name' => 'transcript_edit',
        'contents' => $this->transcriptEdit
      ];
    }

    if ($this->tagAudioEvents !== null) {
      $parts[] = [
        'name' => 'tag_audio_events',
        'contents' => $this->tagAudioEvents ? 'true' : 'false'
      ];
    }

    if ($this->numSpeakers !== null) {
      $parts[] = [
        'name' => 'num_speakers',
        'contents' => (string) $this->numSpeakers
      ];
    }

    if ($this->timestampsGranularity !== null) {
      $parts[] = [
        'name' => 'timestamps_granularity',
        'contents' => $this->timestampsGranularity
      ];
    }

    if ($this->diarize !== null) {
      $parts[] = [
        'name' => 'diarize',
        'contents' => $this->diarize ? 'true' : 'false'
      ];
    }

    if ($this->diarizationThreshold !== null) {
      $parts[] = [
        'name' => 'diarization_threshold',
        'contents' => (string) $this->diarizationThreshold
      ];
    }

    if ($this->additionalFormats !== null) {
      $parts[] = [
        'name' => 'additional_formats',
        'contents' => json_encode($this->additionalFormats),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->fileFormat !== null) {
      $parts[] = [
        'name' => 'file_format',
        'contents' => $this->fileFormat
      ];
    }

    if ($this->sourceUrl !== null) {
      $parts[] = [
        'name' => 'source_url',
        'contents' => $this->sourceUrl
      ];
    }

    if ($this->webhook !== null) {
      $parts[] = [
        'name' => 'webhook',
        'contents' => $this->webhook ? 'true' : 'false'
      ];
    }

    if ($this->webhookId !== null) {
      $parts[] = [
        'name' => 'webhook_id',
        'contents' => $this->webhookId
      ];
    }

    if ($this->temperature !== null) {
      $parts[] = [
        'name' => 'temperature',
        'contents' => (string) $this->temperature
      ];
    }

    if ($this->seed !== null) {
      $parts[] = [
        'name' => 'seed',
        'contents' => (string) $this->seed
      ];
    }

    if ($this->useMultiChannel !== null) {
      $parts[] = [
        'name' => 'use_multi_channel',
        'contents' => $this->useMultiChannel ? 'true' : 'false'
      ];
    }

    if ($this->multichannelOutputStyle !== null) {
      $parts[] = [
        'name' => 'multichannel_output_style',
        'contents' => $this->multichannelOutputStyle
      ];
    }

    if ($this->webhookMetadata !== null) {
      $parts[] = [
        'name' => 'webhook_metadata',
        'contents' => json_encode($this->webhookMetadata),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->entityDetection !== null) {
      $parts[] = [
        'name' => 'entity_detection',
        'contents' => json_encode($this->entityDetection),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->noVerbatim !== null) {
      $parts[] = [
        'name' => 'no_verbatim',
        'contents' => $this->noVerbatim ? 'true' : 'false'
      ];
    }

    if ($this->useSpeakerLibrary !== null) {
      $parts[] = [
        'name' => 'use_speaker_library',
        'contents' => $this->useSpeakerLibrary ? 'true' : 'false'
      ];
    }

    if ($this->detectSpeakerRoles !== null) {
      $parts[] = [
        'name' => 'detect_speaker_roles',
        'contents' => $this->detectSpeakerRoles ? 'true' : 'false'
      ];
    }

    if ($this->entityRedaction !== null) {
      $parts[] = [
        'name' => 'entity_redaction',
        'contents' => json_encode($this->entityRedaction),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->entityRedactionMode !== null) {
      $parts[] = [
        'name' => 'entity_redaction_mode',
        'contents' => $this->entityRedactionMode
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

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->numSpeakers, 'num_speakers', min: 1, max: 32);
    Validator::validateNumber(
      $this->diarizationThreshold,
      'diarization_threshold',
      min: 0.1,
      max: 0.4
    );
    Validator::validateArray($this->additionalFormats, 'additional_formats', maxItems: 10);
    Validator::validateNumber($this->temperature, 'temperature', min: 0, max: 2);
    Validator::validateNumber($this->seed, 'seed', min: 0, max: 2147483647);
  }
}

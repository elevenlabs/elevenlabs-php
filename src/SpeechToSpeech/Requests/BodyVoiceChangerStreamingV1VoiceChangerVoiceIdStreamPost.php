<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechToSpeech\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyVoiceChangerStreamingV1VoiceChangerVoiceIdStreamPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * When enable_logging is set to false zero retention mode will be used for the request. This will mean history features are unavailable for this request, including request stitching. Zero retention mode may only be used by enterprise customers.
   */
  public ?bool $enableLogging;

  /**
   * You can turn on latency optimizations at some cost of quality. The best possible final latency varies by model. Possible values:
   * 0 - default mode (no latency optimizations)
   * 1 - normal latency optimizations (about 50% of possible latency improvement of option 3)
   * 2 - strong latency optimizations (about 75% of possible latency improvement of option 3)
   * 3 - max latency optimizations
   * 4 - max latency optimizations, but also with text normalizer turned off for even more latency savings (best latency, but can mispronounce eg numbers and dates).
   *
   * Defaults to None.
   *
   */
  public ?int $optimizeStreamingLatency;

  /**
   * @var ?value-of<\ElevenLabs\SpeechToSpeech\Types\StreamSpeechToSpeechRequestOutputFormat>
   * Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
   */
  public ?string $outputFormat;

  /**
   * @var \ElevenLabs\Utils\File
   * The audio file which holds the content and emotion that will control the generated speech.
   */
  #[JsonProperty('audio', required: true)]
  public \ElevenLabs\Utils\File $audio;

  /**
   * Identifier of the model that will be used, you can query them using GET /v1/models. The model needs to have support for speech to speech, you can check this using the can_do_voice_conversion property.
   */
  #[JsonProperty('model_id')]
  public ?string $modelId;

  /**
   * Voice settings overriding stored settings for the given voice. They are applied only on the given request. Needs to be send as a JSON encoded string.
   */
  #[JsonProperty('voice_settings')]
  public ?string $voiceSettings;

  /**
   * If specified, our system will make a best effort to sample deterministically, such that repeated requests with the same seed and parameters should return the same result. Determinism is not guaranteed. Must be integer between 0 and 4294967295.
   */
  #[JsonProperty('seed')]
  public ?int $seed;

  /**
   * If set, will remove the background noise from your audio input using our audio isolation model. Only applies to Voice Changer.
   */
  #[JsonProperty('remove_background_noise')]
  public ?bool $removeBackgroundNoise;

  /**
   * @var ?value-of<\ElevenLabs\SpeechToSpeech\Types\SpeechToSpeechStreamRequestFileFormat>
   * The format of input audio. Options are 'pcm_s16le_16' or 'other' For `pcm_s16le_16`, the input audio must be 16-bit PCM at a 16kHz sample rate, single channel (mono), and little-endian byte order. Latency will be lower than with passing an encoded waveform.
   */
  #[JsonProperty('file_format')]
  public ?string $fileFormat;

  /**
   * @param array{
   *   audio: \ElevenLabs\Utils\File,
   *   enableLogging?: ?bool,
   *   optimizeStreamingLatency?: ?int,
   *   outputFormat?: ?value-of<\ElevenLabs\SpeechToSpeech\Types\StreamSpeechToSpeechRequestOutputFormat>,
   *   modelId?: ?string,
   *   voiceSettings?: ?string,
   *   seed?: ?int,
   *   removeBackgroundNoise?: ?bool,
   *   fileFormat?: ?value-of<\ElevenLabs\SpeechToSpeech\Types\SpeechToSpeechStreamRequestFileFormat>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->enableLogging = $values['enableLogging'] ?? null;
    $this->optimizeStreamingLatency = $values['optimizeStreamingLatency'] ?? null;
    $this->outputFormat = $values['outputFormat'] ?? null;
    $this->audio = $values['audio'];
    $this->modelId = $values['modelId'] ?? null;
    $this->voiceSettings = $values['voiceSettings'] ?? null;
    $this->seed = $values['seed'] ?? null;
    $this->removeBackgroundNoise = $values['removeBackgroundNoise'] ?? null;
    $this->fileFormat = $values['fileFormat'] ?? null;

    $this->_dirtyFields = [
      'audio' => true
    ];
    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
    }
    if (array_key_exists('voiceSettings', $values)) {
      $this->_dirtyFields['voice_settings'] = true;
    }
    if (array_key_exists('seed', $values)) {
      $this->_dirtyFields['seed'] = true;
    }
    if (array_key_exists('removeBackgroundNoise', $values)) {
      $this->_dirtyFields['remove_background_noise'] = true;
    }
    if (array_key_exists('fileFormat', $values)) {
      $this->_dirtyFields['file_format'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = $this->audio->toMultipartFormDataPart('audio')->toGuzzlePart();

    if ($this->modelId !== null) {
      $parts[] = [
        'name' => 'model_id',
        'contents' => $this->modelId
      ];
    }

    if ($this->voiceSettings !== null) {
      $parts[] = [
        'name' => 'voice_settings',
        'contents' => $this->voiceSettings
      ];
    }

    if ($this->seed !== null) {
      $parts[] = [
        'name' => 'seed',
        'contents' => (string) $this->seed
      ];
    }

    if ($this->removeBackgroundNoise !== null) {
      $parts[] = [
        'name' => 'remove_background_noise',
        'contents' => $this->removeBackgroundNoise ? 'true' : 'false'
      ];
    }

    if ($this->fileFormat !== null) {
      $parts[] = [
        'name' => 'file_format',
        'contents' => $this->fileFormat
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\TextToVoice\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class VoiceDesignRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AllowedOutputFormats>
   * Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
   */
  public ?string $outputFormat;

  /**
   * Description to use for the created voice.
   */
  #[JsonProperty('voice_description', required: true)]
  public string $voiceDescription;

  /**
   * @var ?value-of<\ElevenLabs\TextToVoice\Types\VoiceDesignRequestModelModelId>
   * Model to use for the voice generation. Possible values: eleven_multilingual_ttv_v2, eleven_ttv_v3.
   */
  #[JsonProperty('model_id')]
  public ?string $modelId;

  /**
   * Text to generate, text length has to be between 100 and 1000.
   */
  #[JsonProperty('text')]
  public ?string $text;

  /**
   * Whether to automatically generate a text suitable for the voice description.
   */
  #[JsonProperty('auto_generate_text')]
  public ?bool $autoGenerateText;

  /**
   * Controls the volume level of the generated voice. -1 is quietest, 1 is loudest, 0 corresponds to roughly -24 LUFS.
   */
  #[JsonProperty('loudness')]
  public ?float $loudness;

  /**
   * Random number that controls the voice generation. Same seed with same inputs produces same voice.
   */
  #[JsonProperty('seed')]
  public ?int $seed;

  /**
   * Controls how closely the AI follows the prompt. Lower numbers give the AI more freedom to be creative, while higher numbers force it to stick more to the prompt. High numbers can cause voice to sound artificial or robotic. We recommend to use longer, more detailed prompts at lower Guidance Scale.
   */
  #[JsonProperty('guidance_scale')]
  public ?float $guidanceScale;

  /**
   * Determines whether the Text to Voice previews should be included in the response. If true, only the generated IDs will be returned which can then be streamed via the /v1/text-to-voice/:generated_voice_id/stream endpoint.
   */
  #[JsonProperty('stream_previews')]
  public ?bool $streamPreviews;

  /**
   * Whether to enhance the voice description using AI to add more detail and improve voice generation quality. When enabled, the system will automatically expand simple prompts into more detailed voice descriptions. Defaults to False
   */
  #[JsonProperty('should_enhance')]
  public ?bool $shouldEnhance;

  /**
   * The remixing session id.
   */
  #[JsonProperty('remixing_session_id')]
  public ?string $remixingSessionId;

  /**
   * The id of the remixing session iteration where these generations should be attached to. If not provided, a new iteration will be created.
   */
  #[JsonProperty('remixing_session_iteration_id')]
  public ?string $remixingSessionIterationId;

  /**
   * Higher quality results in better voice output but less variety.
   */
  #[JsonProperty('quality')]
  public ?float $quality;

  /**
   * Reference audio to use for the voice generation. The audio should be base64 encoded. Only supported when using the  eleven_ttv_v3 model.
   */
  #[JsonProperty('reference_audio_base64')]
  public ?string $referenceAudioBase64;

  /**
   * Controls the balance of prompt versus reference audio when generating voice samples. 0 means almost no prompt influence, 1 means almost no reference audio influence. Only supported when using the eleven_ttv_v3 model.
   */
  #[JsonProperty('prompt_strength')]
  public ?float $promptStrength;

  /**
   * @param array{
   *   voiceDescription: string,
   *   outputFormat?: ?value-of<\ElevenLabs\Types\AllowedOutputFormats>,
   *   modelId?: ?value-of<\ElevenLabs\TextToVoice\Types\VoiceDesignRequestModelModelId>,
   *   text?: ?string,
   *   autoGenerateText?: ?bool,
   *   loudness?: ?float,
   *   seed?: ?int,
   *   guidanceScale?: ?float,
   *   streamPreviews?: ?bool,
   *   shouldEnhance?: ?bool,
   *   remixingSessionId?: ?string,
   *   remixingSessionIterationId?: ?string,
   *   quality?: ?float,
   *   referenceAudioBase64?: ?string,
   *   promptStrength?: ?float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->outputFormat = $values['outputFormat'] ?? null;
    $this->voiceDescription = $values['voiceDescription'];
    $this->modelId = $values['modelId'] ?? null;
    $this->text = $values['text'] ?? null;
    $this->autoGenerateText = $values['autoGenerateText'] ?? null;
    $this->loudness = $values['loudness'] ?? null;
    $this->seed = $values['seed'] ?? null;
    $this->guidanceScale = $values['guidanceScale'] ?? null;
    $this->streamPreviews = $values['streamPreviews'] ?? null;
    $this->shouldEnhance = $values['shouldEnhance'] ?? null;
    $this->remixingSessionId = $values['remixingSessionId'] ?? null;
    $this->remixingSessionIterationId = $values['remixingSessionIterationId'] ?? null;
    $this->quality = $values['quality'] ?? null;
    $this->referenceAudioBase64 = $values['referenceAudioBase64'] ?? null;
    $this->promptStrength = $values['promptStrength'] ?? null;

    $this->_dirtyFields = [
      'voice_description' => true
    ];
    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
    }
    if (array_key_exists('text', $values)) {
      $this->_dirtyFields['text'] = true;
    }
    if (array_key_exists('autoGenerateText', $values)) {
      $this->_dirtyFields['auto_generate_text'] = true;
    }
    if (array_key_exists('loudness', $values)) {
      $this->_dirtyFields['loudness'] = true;
    }
    if (array_key_exists('seed', $values)) {
      $this->_dirtyFields['seed'] = true;
    }
    if (array_key_exists('guidanceScale', $values)) {
      $this->_dirtyFields['guidance_scale'] = true;
    }
    if (array_key_exists('streamPreviews', $values)) {
      $this->_dirtyFields['stream_previews'] = true;
    }
    if (array_key_exists('shouldEnhance', $values)) {
      $this->_dirtyFields['should_enhance'] = true;
    }
    if (array_key_exists('remixingSessionId', $values)) {
      $this->_dirtyFields['remixing_session_id'] = true;
    }
    if (array_key_exists('remixingSessionIterationId', $values)) {
      $this->_dirtyFields['remixing_session_iteration_id'] = true;
    }
    if (array_key_exists('quality', $values)) {
      $this->_dirtyFields['quality'] = true;
    }
    if (array_key_exists('referenceAudioBase64', $values)) {
      $this->_dirtyFields['reference_audio_base64'] = true;
    }
    if (array_key_exists('promptStrength', $values)) {
      $this->_dirtyFields['prompt_strength'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'voice_description',
      'contents' => $this->voiceDescription
    ];

    if ($this->modelId !== null) {
      $parts[] = [
        'name' => 'model_id',
        'contents' => $this->modelId
      ];
    }

    if ($this->text !== null) {
      $parts[] = [
        'name' => 'text',
        'contents' => $this->text
      ];
    }

    if ($this->autoGenerateText !== null) {
      $parts[] = [
        'name' => 'auto_generate_text',
        'contents' => $this->autoGenerateText ? 'true' : 'false'
      ];
    }

    if ($this->loudness !== null) {
      $parts[] = [
        'name' => 'loudness',
        'contents' => (string) $this->loudness
      ];
    }

    if ($this->seed !== null) {
      $parts[] = [
        'name' => 'seed',
        'contents' => (string) $this->seed
      ];
    }

    if ($this->guidanceScale !== null) {
      $parts[] = [
        'name' => 'guidance_scale',
        'contents' => (string) $this->guidanceScale
      ];
    }

    if ($this->streamPreviews !== null) {
      $parts[] = [
        'name' => 'stream_previews',
        'contents' => $this->streamPreviews ? 'true' : 'false'
      ];
    }

    if ($this->shouldEnhance !== null) {
      $parts[] = [
        'name' => 'should_enhance',
        'contents' => $this->shouldEnhance ? 'true' : 'false'
      ];
    }

    if ($this->remixingSessionId !== null) {
      $parts[] = [
        'name' => 'remixing_session_id',
        'contents' => $this->remixingSessionId
      ];
    }

    if ($this->remixingSessionIterationId !== null) {
      $parts[] = [
        'name' => 'remixing_session_iteration_id',
        'contents' => $this->remixingSessionIterationId
      ];
    }

    if ($this->quality !== null) {
      $parts[] = [
        'name' => 'quality',
        'contents' => (string) $this->quality
      ];
    }

    if ($this->referenceAudioBase64 !== null) {
      $parts[] = [
        'name' => 'reference_audio_base64',
        'contents' => $this->referenceAudioBase64
      ];
    }

    if ($this->promptStrength !== null) {
      $parts[] = [
        'name' => 'prompt_strength',
        'contents' => (string) $this->promptStrength
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString(
      $this->voiceDescription,
      'voice_description',
      minLength: 20,
      maxLength: 1000
    );
    Validator::validateString($this->text, 'text', minLength: 100, maxLength: 1000);
    Validator::validateNumber($this->loudness, 'loudness', min: -1, max: 1);
    Validator::validateNumber($this->seed, 'seed', min: 0, max: 2147483647);
    Validator::validateNumber($this->guidanceScale, 'guidance_scale', min: 0, max: 100);
    Validator::validateNumber($this->quality, 'quality', min: -1, max: 1);
    Validator::validateNumber($this->promptStrength, 'prompt_strength', min: 0, max: 1);
  }
}

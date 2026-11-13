<?php

declare(strict_types=1);

namespace ElevenLabs\TextToSoundEffects\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CreateSoundEffectRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\TextToSoundEffects\Types\ConvertTextToSoundEffectsRequestOutputFormat>
   * Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM and WAV formats with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
   */
  public ?string $outputFormat;

  /**
   * When enable_logging is set to false zero retention mode will be used for the request. Zero retention mode may only be used by enterprise customers.
   */
  public ?bool $enableLogging;

  /**
   * The text that will get converted into a sound effect.
   */
  #[JsonProperty('text', required: true)]
  public string $text;

  /**
   * Whether to create a sound effect that loops smoothly.
   */
  #[JsonProperty('loop')]
  public ?bool $loop;

  /**
   * The duration of the sound which will be generated in seconds. Must be at least 0.5 and at most 30. If set to None we will guess the optimal duration using the prompt. Defaults to None.
   */
  #[JsonProperty('duration_seconds')]
  public ?float $durationSeconds;

  /**
   * A higher prompt influence makes your generation follow the prompt more closely while also making generations less variable. Must be a value between 0 and 1. Defaults to 0.3.
   */
  #[JsonProperty('prompt_influence')]
  public ?float $promptInfluence;

  /**
   * @var ?value-of<\ElevenLabs\Types\SfxModelId>
   */
  #[JsonProperty('model_id')]
  public ?string $modelId;

  /**
   * @param array{
   *   text: string,
   *   outputFormat?: ?value-of<\ElevenLabs\TextToSoundEffects\Types\ConvertTextToSoundEffectsRequestOutputFormat>,
   *   enableLogging?: ?bool,
   *   loop?: ?bool,
   *   durationSeconds?: ?float,
   *   promptInfluence?: ?float,
   *   modelId?: ?value-of<\ElevenLabs\Types\SfxModelId>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->outputFormat = $values['outputFormat'] ?? null;
    $this->enableLogging = $values['enableLogging'] ?? null;
    $this->text = $values['text'];
    $this->loop = $values['loop'] ?? null;
    $this->durationSeconds = $values['durationSeconds'] ?? null;
    $this->promptInfluence = $values['promptInfluence'] ?? null;
    $this->modelId = $values['modelId'] ?? null;

    $this->_dirtyFields = [
      'text' => true
    ];
    if (array_key_exists('loop', $values)) {
      $this->_dirtyFields['loop'] = true;
    }
    if (array_key_exists('durationSeconds', $values)) {
      $this->_dirtyFields['duration_seconds'] = true;
    }
    if (array_key_exists('promptInfluence', $values)) {
      $this->_dirtyFields['prompt_influence'] = true;
    }
    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'text',
      'contents' => $this->text
    ];

    if ($this->loop !== null) {
      $parts[] = [
        'name' => 'loop',
        'contents' => $this->loop ? 'true' : 'false'
      ];
    }

    if ($this->durationSeconds !== null) {
      $parts[] = [
        'name' => 'duration_seconds',
        'contents' => (string) $this->durationSeconds
      ];
    }

    if ($this->promptInfluence !== null) {
      $parts[] = [
        'name' => 'prompt_influence',
        'contents' => (string) $this->promptInfluence
      ];
    }

    if ($this->modelId !== null) {
      $parts[] = [
        'name' => 'model_id',
        'contents' => $this->modelId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

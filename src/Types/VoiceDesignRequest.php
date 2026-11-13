<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

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
class VoiceDesignRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Description to use for the created voice.
   */
  #[JsonProperty('voice_description', required: true)]
  public string $voiceDescription;

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
   * Higher quality results in better voice output but less variety.
   */
  #[JsonProperty('quality')]
  public ?float $quality;

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
   * Whether to enhance the voice description using AI to add more detail and improve voice generation quality. When enabled, the system will automatically expand simple prompts into more detailed voice descriptions. Defaults to False
   */
  #[JsonProperty('should_enhance')]
  public ?bool $shouldEnhance;

  /**
   * @param array{
   *   voiceDescription: string,
   *   text?: ?string,
   *   autoGenerateText?: ?bool,
   *   loudness?: ?float,
   *   quality?: ?float,
   *   seed?: ?int,
   *   guidanceScale?: ?float,
   *   shouldEnhance?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->voiceDescription = $values['voiceDescription'];
    $this->text = $values['text'] ?? null;
    $this->autoGenerateText = $values['autoGenerateText'] ?? null;
    $this->loudness = $values['loudness'] ?? null;
    $this->quality = $values['quality'] ?? null;
    $this->seed = $values['seed'] ?? null;
    $this->guidanceScale = $values['guidanceScale'] ?? null;
    $this->shouldEnhance = $values['shouldEnhance'] ?? null;

    $this->_dirtyFields = [
      'voice_description' => true
    ];
    if (array_key_exists('text', $values)) {
      $this->_dirtyFields['text'] = true;
    }
    if (array_key_exists('autoGenerateText', $values)) {
      $this->_dirtyFields['auto_generate_text'] = true;
    }
    if (array_key_exists('loudness', $values)) {
      $this->_dirtyFields['loudness'] = true;
    }
    if (array_key_exists('quality', $values)) {
      $this->_dirtyFields['quality'] = true;
    }
    if (array_key_exists('seed', $values)) {
      $this->_dirtyFields['seed'] = true;
    }
    if (array_key_exists('guidanceScale', $values)) {
      $this->_dirtyFields['guidance_scale'] = true;
    }
    if (array_key_exists('shouldEnhance', $values)) {
      $this->_dirtyFields['should_enhance'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'voice_description',
      'contents' => $this->voiceDescription
    ];

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

    if ($this->quality !== null) {
      $parts[] = [
        'name' => 'quality',
        'contents' => (string) $this->quality
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

    if ($this->shouldEnhance !== null) {
      $parts[] = [
        'name' => 'should_enhance',
        'contents' => $this->shouldEnhance ? 'true' : 'false'
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
    Validator::validateNumber($this->quality, 'quality', min: -1, max: 1);
    Validator::validateNumber($this->seed, 'seed', min: 0, max: 2147483647);
    Validator::validateNumber($this->guidanceScale, 'guidance_scale', min: 0, max: 100);
  }
}

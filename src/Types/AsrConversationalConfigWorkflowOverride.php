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
class AsrConversationalConfigWorkflowOverride extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AsrQuality>
   * The quality of the transcription
   */
  #[JsonProperty('quality')]
  public ?string $quality;

  /**
   * @var ?value-of<\ElevenLabs\Types\AsrProvider>
   * The provider of the transcription service
   */
  #[JsonProperty('provider')]
  public ?string $provider;

  /**
   * @var ?value-of<\ElevenLabs\Types\AsrInputFormat>
   * The format of the audio to be transcribed
   */
  #[JsonProperty('user_input_audio_format')]
  public ?string $userInputAudioFormat;

  /**
   * @var string[]|null
   * Keywords to boost prediction probability for
   */
  #[JsonProperty('keywords'), ArrayType(['string'])]
  public ?array $keywords;

  /**
   * @param array{
   *   quality?: ?value-of<\ElevenLabs\Types\AsrQuality>,
   *   provider?: ?value-of<\ElevenLabs\Types\AsrProvider>,
   *   userInputAudioFormat?: ?value-of<\ElevenLabs\Types\AsrInputFormat>,
   *   keywords?: string[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->quality = $values['quality'] ?? 'high';
    $this->provider = $values['provider'] ?? null;
    $this->userInputAudioFormat = $values['userInputAudioFormat'] ?? null;
    $this->keywords = $values['keywords'] ?? null;

    if (array_key_exists('quality', $values)) {
      $this->_dirtyFields['quality'] = true;
    }
    if (array_key_exists('provider', $values)) {
      $this->_dirtyFields['provider'] = true;
    }
    if (array_key_exists('userInputAudioFormat', $values)) {
      $this->_dirtyFields['user_input_audio_format'] = true;
    }
    if (array_key_exists('keywords', $values)) {
      $this->_dirtyFields['keywords'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->quality !== null) {
      $parts[] = [
        'name' => 'quality',
        'contents' => $this->quality
      ];
    }

    if ($this->provider !== null) {
      $parts[] = [
        'name' => 'provider',
        'contents' => $this->provider
      ];
    }

    if ($this->userInputAudioFormat !== null) {
      $parts[] = [
        'name' => 'user_input_audio_format',
        'contents' => $this->userInputAudioFormat
      ];
    }

    if ($this->keywords !== null) {
      foreach ($this->keywords ?? [] as $item) {
        $parts[] = [
          'name' => 'keywords',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class OpenAiAudioInputConfigInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('format')]
  public ?\ElevenLabs\Types\OpenAiAudioInputFormat $format;

  #[JsonProperty('transcription')]
  public ?\ElevenLabs\Types\OpenAiAudioInputTranscription $transcription;

  #[JsonProperty('turn_detection')]
  public ?\ElevenLabs\Types\OpenAiTurnDetection $turnDetection;

  /**
   * @var ?value-of<\ElevenLabs\Types\AudioInputPacing>
   * ``BURSTY`` clients stream ahead of wall time, so decisions use the audio clock.
   */
  #[JsonProperty('pacing')]
  public ?string $pacing;

  /**
   * @param array{
   *   format?: ?\ElevenLabs\Types\OpenAiAudioInputFormat,
   *   transcription?: ?\ElevenLabs\Types\OpenAiAudioInputTranscription,
   *   turnDetection?: ?\ElevenLabs\Types\OpenAiTurnDetection,
   *   pacing?: ?value-of<\ElevenLabs\Types\AudioInputPacing>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->format = $values['format'] ?? null;
    $this->transcription = $values['transcription'] ?? null;
    $this->turnDetection = $values['turnDetection'] ?? null;
    $this->pacing = $values['pacing'] ?? null;

    if (array_key_exists('format', $values)) {
      $this->_dirtyFields['format'] = true;
    }
    if (array_key_exists('transcription', $values)) {
      $this->_dirtyFields['transcription'] = true;
    }
    if (array_key_exists('turnDetection', $values)) {
      $this->_dirtyFields['turn_detection'] = true;
    }
    if (array_key_exists('pacing', $values)) {
      $this->_dirtyFields['pacing'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->format !== null) {
      $parts[] = [
        'name' => 'format',
        'contents' => json_encode($this->format),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->transcription !== null) {
      $parts[] = [
        'name' => 'transcription',
        'contents' => json_encode($this->transcription),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->turnDetection !== null) {
      $parts[] = [
        'name' => 'turn_detection',
        'contents' => json_encode($this->turnDetection),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->pacing !== null) {
      $parts[] = [
        'name' => 'pacing',
        'contents' => $this->pacing
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->format?->validate();
    $this->transcription?->validate();
    $this->turnDetection?->validate();
  }
}

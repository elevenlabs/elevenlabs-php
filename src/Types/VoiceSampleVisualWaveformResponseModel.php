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
class VoiceSampleVisualWaveformResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the sample.
   */
  #[JsonProperty('sample_id', required: true)]
  public string $sampleId;

  /**
   * @var float[]
   * The visual waveform of the sample, represented as a list of floats.
   */
  #[JsonProperty('visual_waveform', required: true), ArrayType(['float'])]
  public array $visualWaveform;

  /**
   * @param array{
   *   sampleId: string,
   *   visualWaveform: float[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->sampleId = $values['sampleId'];
    $this->visualWaveform = $values['visualWaveform'];

    $this->_dirtyFields = [
      'sample_id' => true,
      'visual_waveform' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'sample_id',
      'contents' => $this->sampleId
    ];

    foreach ($this->visualWaveform as $item) {
      $parts[] = [
        'name' => 'visual_waveform',
        'contents' => (string) $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

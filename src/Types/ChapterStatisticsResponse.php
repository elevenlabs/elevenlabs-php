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
class ChapterStatisticsResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The number of unconverted characters.
   */
  #[JsonProperty('characters_unconverted', required: true)]
  public int $charactersUnconverted;

  /**
   * The number of converted characters.
   */
  #[JsonProperty('characters_converted', required: true)]
  public int $charactersConverted;

  /**
   * The number of converted paragraphs.
   */
  #[JsonProperty('paragraphs_converted', required: true)]
  public int $paragraphsConverted;

  /**
   * The number of unconverted paragraphs.
   */
  #[JsonProperty('paragraphs_unconverted', required: true)]
  public int $paragraphsUnconverted;

  /**
   * The number of credits needed to convert the remaining paragraphs.
   */
  #[JsonProperty('credits_needed_to_convert')]
  public ?int $creditsNeededToConvert;

  /**
   * @var \ElevenLabs\Types\VoiceStatisticsResponseModel[]|null
   * Per-voice breakdown of character counts.
   */
  #[
    JsonProperty('voice_statistics'),
    ArrayType([\ElevenLabs\Types\VoiceStatisticsResponseModel::class])
  ]
  public ?array $voiceStatistics;

  /**
   * @param array{
   *   charactersUnconverted: int,
   *   charactersConverted: int,
   *   paragraphsConverted: int,
   *   paragraphsUnconverted: int,
   *   creditsNeededToConvert?: ?int,
   *   voiceStatistics?: \ElevenLabs\Types\VoiceStatisticsResponseModel[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->charactersUnconverted = $values['charactersUnconverted'];
    $this->charactersConverted = $values['charactersConverted'];
    $this->paragraphsConverted = $values['paragraphsConverted'];
    $this->paragraphsUnconverted = $values['paragraphsUnconverted'];
    $this->creditsNeededToConvert = $values['creditsNeededToConvert'] ?? null;
    $this->voiceStatistics = $values['voiceStatistics'] ?? null;

    $this->_dirtyFields = [
      'characters_unconverted' => true,
      'characters_converted' => true,
      'paragraphs_converted' => true,
      'paragraphs_unconverted' => true
    ];
    if (array_key_exists('creditsNeededToConvert', $values)) {
      $this->_dirtyFields['credits_needed_to_convert'] = true;
    }
    if (array_key_exists('voiceStatistics', $values)) {
      $this->_dirtyFields['voice_statistics'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'characters_unconverted',
      'contents' => (string) $this->charactersUnconverted
    ];

    $parts[] = [
      'name' => 'characters_converted',
      'contents' => (string) $this->charactersConverted
    ];

    $parts[] = [
      'name' => 'paragraphs_converted',
      'contents' => (string) $this->paragraphsConverted
    ];

    $parts[] = [
      'name' => 'paragraphs_unconverted',
      'contents' => (string) $this->paragraphsUnconverted
    ];

    if ($this->creditsNeededToConvert !== null) {
      $parts[] = [
        'name' => 'credits_needed_to_convert',
        'contents' => (string) $this->creditsNeededToConvert
      ];
    }

    if ($this->voiceStatistics !== null) {
      $parts[] = [
        'name' => 'voice_statistics',
        'contents' => json_encode($this->voiceStatistics),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->voiceStatistics ?? [] as $item) {
      $item->validate();
    }
  }
}

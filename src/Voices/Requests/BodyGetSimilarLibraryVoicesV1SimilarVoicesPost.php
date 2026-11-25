<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyGetSimilarLibraryVoicesV1SimilarVoicesPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Voices\Types\FindSimilarVoicesVoicesRequestCategory>
   * Voice category used for filtering
   */
  public ?string $category;

  /**
   * Gender used for filtering
   */
  public ?string $gender;

  /**
   * Age used for filtering
   */
  public ?string $age;

  /**
   * @var string[]|null
   * Use-case used for filtering
   */
  public ?array $useCases;

  /**
   * Filter voices with a minimum notice period of the given number of days.
   */
  public ?int $minNoticePeriodDays;

  /**
   * Include/exclude voices with custom rates
   */
  public ?bool $includeCustomRates;

  /**
   * Include/exclude voices that are live moderated
   */
  public ?bool $includeLiveModerated;

  /**
   * Filter voices by public owner ID
   */
  public ?string $ownerId;

  /**
   * @var ?\ElevenLabs\Utils\File
   */
  #[JsonProperty('audio_file')]
  public ?\ElevenLabs\Utils\File $audioFile;

  /**
   * Threshold for voice similarity between provided sample and library voices. Values range from 0 to 2. The smaller the value the more similar voices will be returned.
   */
  #[JsonProperty('similarity_threshold')]
  public ?float $similarityThreshold;

  /**
   * Number of most similar voices to return. If similarity_threshold is provided, less than this number of voices may be returned. Values range from 1 to 100.
   */
  #[JsonProperty('top_k')]
  public ?int $topK;

  /**
   * @param array{
   *   category?: ?value-of<\ElevenLabs\Voices\Types\FindSimilarVoicesVoicesRequestCategory>,
   *   gender?: ?string,
   *   age?: ?string,
   *   useCases?: string[]|null,
   *   minNoticePeriodDays?: ?int,
   *   includeCustomRates?: ?bool,
   *   includeLiveModerated?: ?bool,
   *   ownerId?: ?string,
   *   audioFile?: ?\ElevenLabs\Utils\File,
   *   similarityThreshold?: ?float,
   *   topK?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->category = $values['category'] ?? null;
    $this->gender = $values['gender'] ?? null;
    $this->age = $values['age'] ?? null;
    $this->useCases = $values['useCases'] ?? null;
    $this->minNoticePeriodDays = $values['minNoticePeriodDays'] ?? null;
    $this->includeCustomRates = $values['includeCustomRates'] ?? null;
    $this->includeLiveModerated = $values['includeLiveModerated'] ?? null;
    $this->ownerId = $values['ownerId'] ?? null;
    $this->audioFile = $values['audioFile'] ?? null;
    $this->similarityThreshold = $values['similarityThreshold'] ?? null;
    $this->topK = $values['topK'] ?? null;

    if (array_key_exists('audioFile', $values)) {
      $this->_dirtyFields['audio_file'] = true;
    }
    if (array_key_exists('similarityThreshold', $values)) {
      $this->_dirtyFields['similarity_threshold'] = true;
    }
    if (array_key_exists('topK', $values)) {
      $this->_dirtyFields['top_k'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->audioFile !== null) {
      $parts[] = $this->audioFile->toMultipartFormDataPart('audio_file')->toGuzzlePart();
    }

    if ($this->similarityThreshold !== null) {
      $parts[] = [
        'name' => 'similarity_threshold',
        'contents' => (string) $this->similarityThreshold
      ];
    }

    if ($this->topK !== null) {
      $parts[] = [
        'name' => 'top_k',
        'contents' => (string) $this->topK
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

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
class ChapterResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the chapter.
   */
  #[JsonProperty('chapter_id', required: true)]
  public string $chapterId;

  /**
   * The name of the chapter.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The last conversion date of the chapter.
   */
  #[JsonProperty('last_conversion_date_unix')]
  public ?int $lastConversionDateUnix;

  /**
   * The conversion progress of the chapter.
   */
  #[JsonProperty('conversion_progress')]
  public ?float $conversionProgress;

  /**
   * Whether the chapter can be downloaded.
   */
  #[JsonProperty('can_be_downloaded', required: true)]
  public bool $canBeDownloaded;

  /**
   * @var value-of<\ElevenLabs\Types\ChapterState>
   * The state of the chapter.
   */
  #[JsonProperty('state', required: true)]
  public string $state;

  /**
   * Whether the chapter has a video.
   */
  #[JsonProperty('has_video')]
  public ?bool $hasVideo;

  /**
   * Whether the chapter has any visual content (video, image, or text clips).
   */
  #[JsonProperty('has_visual_content')]
  public ?bool $hasVisualContent;

  /**
   * @var string[]|null
   * List of voice ids used by the chapter
   */
  #[JsonProperty('voice_ids'), ArrayType(['string'])]
  public ?array $voiceIds;

  /**
   * The statistics of the chapter.
   */
  #[JsonProperty('statistics')]
  public ?\ElevenLabs\Types\ChapterStatisticsResponse $statistics;

  /**
   * The last conversion error of the chapter.
   */
  #[JsonProperty('last_conversion_error')]
  public ?string $lastConversionError;

  /**
   * @param array{
   *   chapterId: string,
   *   name: string,
   *   canBeDownloaded: bool,
   *   state: value-of<\ElevenLabs\Types\ChapterState>,
   *   lastConversionDateUnix?: ?int,
   *   conversionProgress?: ?float,
   *   hasVideo?: ?bool,
   *   hasVisualContent?: ?bool,
   *   voiceIds?: string[]|null,
   *   statistics?: ?\ElevenLabs\Types\ChapterStatisticsResponse,
   *   lastConversionError?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->chapterId = $values['chapterId'];
    $this->name = $values['name'];
    $this->lastConversionDateUnix = $values['lastConversionDateUnix'] ?? null;
    $this->conversionProgress = $values['conversionProgress'] ?? null;
    $this->canBeDownloaded = $values['canBeDownloaded'];
    $this->state = $values['state'];
    $this->hasVideo = $values['hasVideo'] ?? null;
    $this->hasVisualContent = $values['hasVisualContent'] ?? null;
    $this->voiceIds = $values['voiceIds'] ?? null;
    $this->statistics = $values['statistics'] ?? null;
    $this->lastConversionError = $values['lastConversionError'] ?? null;

    $this->_dirtyFields = [
      'chapter_id' => true,
      'name' => true,
      'can_be_downloaded' => true,
      'state' => true
    ];
    if (array_key_exists('lastConversionDateUnix', $values)) {
      $this->_dirtyFields['last_conversion_date_unix'] = true;
    }
    if (array_key_exists('conversionProgress', $values)) {
      $this->_dirtyFields['conversion_progress'] = true;
    }
    if (array_key_exists('hasVideo', $values)) {
      $this->_dirtyFields['has_video'] = true;
    }
    if (array_key_exists('hasVisualContent', $values)) {
      $this->_dirtyFields['has_visual_content'] = true;
    }
    if (array_key_exists('voiceIds', $values)) {
      $this->_dirtyFields['voice_ids'] = true;
    }
    if (array_key_exists('statistics', $values)) {
      $this->_dirtyFields['statistics'] = true;
    }
    if (array_key_exists('lastConversionError', $values)) {
      $this->_dirtyFields['last_conversion_error'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'chapter_id',
      'contents' => $this->chapterId
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->lastConversionDateUnix !== null) {
      $parts[] = [
        'name' => 'last_conversion_date_unix',
        'contents' => (string) $this->lastConversionDateUnix
      ];
    }

    if ($this->conversionProgress !== null) {
      $parts[] = [
        'name' => 'conversion_progress',
        'contents' => (string) $this->conversionProgress
      ];
    }

    $parts[] = [
      'name' => 'can_be_downloaded',
      'contents' => $this->canBeDownloaded ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'state',
      'contents' => $this->state
    ];

    if ($this->hasVideo !== null) {
      $parts[] = [
        'name' => 'has_video',
        'contents' => $this->hasVideo ? 'true' : 'false'
      ];
    }

    if ($this->hasVisualContent !== null) {
      $parts[] = [
        'name' => 'has_visual_content',
        'contents' => $this->hasVisualContent ? 'true' : 'false'
      ];
    }

    if ($this->voiceIds !== null) {
      foreach ($this->voiceIds ?? [] as $item) {
        $parts[] = [
          'name' => 'voice_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->statistics !== null) {
      $parts[] = [
        'name' => 'statistics',
        'contents' => json_encode($this->statistics),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->lastConversionError !== null) {
      $parts[] = [
        'name' => 'last_conversion_error',
        'contents' => $this->lastConversionError
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->statistics?->validate();
  }
}

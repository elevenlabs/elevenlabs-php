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
class AudioAnalysisResult extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('title', required: true)]
  public string $title;

  #[JsonProperty('description', required: true)]
  public string $description;

  #[JsonProperty('content_type')]
  public ?string $contentType;

  #[JsonProperty('overall_pacing')]
  public ?string $overallPacing;

  /**
   * @var \ElevenLabs\Types\AudioSegment[]|null
   */
  #[JsonProperty('segments'), ArrayType([\ElevenLabs\Types\AudioSegment::class])]
  public ?array $segments;

  /**
   * @var \ElevenLabs\Types\AudioKeyMoment[]|null
   */
  #[JsonProperty('key_moments'), ArrayType([\ElevenLabs\Types\AudioKeyMoment::class])]
  public ?array $keyMoments;

  /**
   * @param array{
   *   title: string,
   *   description: string,
   *   contentType?: ?string,
   *   overallPacing?: ?string,
   *   segments?: \ElevenLabs\Types\AudioSegment[]|null,
   *   keyMoments?: \ElevenLabs\Types\AudioKeyMoment[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->title = $values['title'];
    $this->description = $values['description'];
    $this->contentType = $values['contentType'] ?? null;
    $this->overallPacing = $values['overallPacing'] ?? null;
    $this->segments = $values['segments'] ?? null;
    $this->keyMoments = $values['keyMoments'] ?? null;

    $this->_dirtyFields = [
      'title' => true,
      'description' => true
    ];
    if (array_key_exists('contentType', $values)) {
      $this->_dirtyFields['content_type'] = true;
    }
    if (array_key_exists('overallPacing', $values)) {
      $this->_dirtyFields['overall_pacing'] = true;
    }
    if (array_key_exists('segments', $values)) {
      $this->_dirtyFields['segments'] = true;
    }
    if (array_key_exists('keyMoments', $values)) {
      $this->_dirtyFields['key_moments'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'title',
      'contents' => $this->title
    ];

    $parts[] = [
      'name' => 'description',
      'contents' => $this->description
    ];

    if ($this->contentType !== null) {
      $parts[] = [
        'name' => 'content_type',
        'contents' => $this->contentType
      ];
    }

    if ($this->overallPacing !== null) {
      $parts[] = [
        'name' => 'overall_pacing',
        'contents' => $this->overallPacing
      ];
    }

    if ($this->segments !== null) {
      $parts[] = [
        'name' => 'segments',
        'contents' => json_encode($this->segments),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->keyMoments !== null) {
      $parts[] = [
        'name' => 'key_moments',
        'contents' => json_encode($this->keyMoments),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->segments ?? [] as $item) {
      $item->validate();
    }
    foreach ($this->keyMoments ?? [] as $item) {
      $item->validate();
    }
  }
}

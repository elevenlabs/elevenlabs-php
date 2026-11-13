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
class VideoAnalysisResult extends JsonSerializableType
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
   * @var \ElevenLabs\Types\VideoSubject[]|null
   */
  #[JsonProperty('subjects'), ArrayType([\ElevenLabs\Types\VideoSubject::class])]
  public ?array $subjects;

  /**
   * @var \ElevenLabs\Types\VideoSegment[]|null
   */
  #[JsonProperty('segments'), ArrayType([\ElevenLabs\Types\VideoSegment::class])]
  public ?array $segments;

  /**
   * @var \ElevenLabs\Types\VideoKeyMoment[]|null
   */
  #[JsonProperty('key_moments'), ArrayType([\ElevenLabs\Types\VideoKeyMoment::class])]
  public ?array $keyMoments;

  /**
   * @param array{
   *   title: string,
   *   description: string,
   *   contentType?: ?string,
   *   overallPacing?: ?string,
   *   subjects?: \ElevenLabs\Types\VideoSubject[]|null,
   *   segments?: \ElevenLabs\Types\VideoSegment[]|null,
   *   keyMoments?: \ElevenLabs\Types\VideoKeyMoment[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->title = $values['title'];
    $this->description = $values['description'];
    $this->contentType = $values['contentType'] ?? null;
    $this->overallPacing = $values['overallPacing'] ?? null;
    $this->subjects = $values['subjects'] ?? null;
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
    if (array_key_exists('subjects', $values)) {
      $this->_dirtyFields['subjects'] = true;
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

    if ($this->subjects !== null) {
      $parts[] = [
        'name' => 'subjects',
        'contents' => json_encode($this->subjects),
        'headers' => ['Content-Type' => 'application/json']
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
    foreach ($this->subjects ?? [] as $item) {
      $item->validate();
    }
    foreach ($this->segments ?? [] as $item) {
      $item->validate();
    }
    foreach ($this->keyMoments ?? [] as $item) {
      $item->validate();
    }
  }
}

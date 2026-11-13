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
class ImageAnalysisResult extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('title', required: true)]
  public string $title;

  #[JsonProperty('description', required: true)]
  public string $description;

  #[JsonProperty('content_type')]
  public ?string $contentType;

  #[JsonProperty('mood_and_style')]
  public ?string $moodAndStyle;

  #[JsonProperty('composition_notes')]
  public ?string $compositionNotes;

  /**
   * Readable text overlaid or shown in the image, if any.
   */
  #[JsonProperty('visible_text')]
  public ?string $visibleText;

  /**
   * @var \ElevenLabs\Types\ImageSubject[]|null
   */
  #[JsonProperty('subjects'), ArrayType([\ElevenLabs\Types\ImageSubject::class])]
  public ?array $subjects;

  /**
   * @param array{
   *   title: string,
   *   description: string,
   *   contentType?: ?string,
   *   moodAndStyle?: ?string,
   *   compositionNotes?: ?string,
   *   visibleText?: ?string,
   *   subjects?: \ElevenLabs\Types\ImageSubject[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->title = $values['title'];
    $this->description = $values['description'];
    $this->contentType = $values['contentType'] ?? null;
    $this->moodAndStyle = $values['moodAndStyle'] ?? null;
    $this->compositionNotes = $values['compositionNotes'] ?? null;
    $this->visibleText = $values['visibleText'] ?? null;
    $this->subjects = $values['subjects'] ?? null;

    $this->_dirtyFields = [
      'title' => true,
      'description' => true
    ];
    if (array_key_exists('contentType', $values)) {
      $this->_dirtyFields['content_type'] = true;
    }
    if (array_key_exists('moodAndStyle', $values)) {
      $this->_dirtyFields['mood_and_style'] = true;
    }
    if (array_key_exists('compositionNotes', $values)) {
      $this->_dirtyFields['composition_notes'] = true;
    }
    if (array_key_exists('visibleText', $values)) {
      $this->_dirtyFields['visible_text'] = true;
    }
    if (array_key_exists('subjects', $values)) {
      $this->_dirtyFields['subjects'] = true;
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

    if ($this->moodAndStyle !== null) {
      $parts[] = [
        'name' => 'mood_and_style',
        'contents' => $this->moodAndStyle
      ];
    }

    if ($this->compositionNotes !== null) {
      $parts[] = [
        'name' => 'composition_notes',
        'contents' => $this->compositionNotes
      ];
    }

    if ($this->visibleText !== null) {
      $parts[] = [
        'name' => 'visible_text',
        'contents' => $this->visibleText
      ];
    }

    if ($this->subjects !== null) {
      $parts[] = [
        'name' => 'subjects',
        'contents' => json_encode($this->subjects),
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
  }
}

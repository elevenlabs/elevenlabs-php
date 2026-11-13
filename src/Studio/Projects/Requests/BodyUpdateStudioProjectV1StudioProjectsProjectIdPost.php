<?php

declare(strict_types=1);

namespace ElevenLabs\Studio\Projects\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyUpdateStudioProjectV1StudioProjectsProjectIdPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The name of the Studio project, used for identification only.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The voice_id that corresponds to the default voice used for new titles.
   */
  #[JsonProperty('default_title_voice_id', required: true)]
  public string $defaultTitleVoiceId;

  /**
   * The voice_id that corresponds to the default voice used for new paragraphs.
   */
  #[JsonProperty('default_paragraph_voice_id', required: true)]
  public string $defaultParagraphVoiceId;

  /**
   * An optional name of the author of the Studio project, this will be added as metadata to the mp3 file on Studio project or chapter download.
   */
  #[JsonProperty('title')]
  public ?string $title;

  /**
   * An optional name of the author of the Studio project, this will be added as metadata to the mp3 file on Studio project or chapter download.
   */
  #[JsonProperty('author')]
  public ?string $author;

  /**
   * An optional ISBN number of the Studio project you want to create, this will be added as metadata to the mp3 file on Studio project or chapter download.
   */
  #[JsonProperty('isbn_number')]
  public ?string $isbnNumber;

  /**
   * When the Studio project is downloaded, should the returned audio have postprocessing in order to make it compliant with audiobook normalized volume requirements
   */
  #[JsonProperty('volume_normalization')]
  public ?bool $volumeNormalization;

  /**
   * @param array{
   *   name: string,
   *   defaultTitleVoiceId: string,
   *   defaultParagraphVoiceId: string,
   *   title?: ?string,
   *   author?: ?string,
   *   isbnNumber?: ?string,
   *   volumeNormalization?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];
    $this->defaultTitleVoiceId = $values['defaultTitleVoiceId'];
    $this->defaultParagraphVoiceId = $values['defaultParagraphVoiceId'];
    $this->title = $values['title'] ?? null;
    $this->author = $values['author'] ?? null;
    $this->isbnNumber = $values['isbnNumber'] ?? null;
    $this->volumeNormalization = $values['volumeNormalization'] ?? null;

    $this->_dirtyFields = [
      'name' => true,
      'default_title_voice_id' => true,
      'default_paragraph_voice_id' => true
    ];
    if (array_key_exists('title', $values)) {
      $this->_dirtyFields['title'] = true;
    }
    if (array_key_exists('author', $values)) {
      $this->_dirtyFields['author'] = true;
    }
    if (array_key_exists('isbnNumber', $values)) {
      $this->_dirtyFields['isbn_number'] = true;
    }
    if (array_key_exists('volumeNormalization', $values)) {
      $this->_dirtyFields['volume_normalization'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'default_title_voice_id',
      'contents' => $this->defaultTitleVoiceId
    ];

    $parts[] = [
      'name' => 'default_paragraph_voice_id',
      'contents' => $this->defaultParagraphVoiceId
    ];

    if ($this->title !== null) {
      $parts[] = [
        'name' => 'title',
        'contents' => $this->title
      ];
    }

    if ($this->author !== null) {
      $parts[] = [
        'name' => 'author',
        'contents' => $this->author
      ];
    }

    if ($this->isbnNumber !== null) {
      $parts[] = [
        'name' => 'isbn_number',
        'contents' => $this->isbnNumber
      ];
    }

    if ($this->volumeNormalization !== null) {
      $parts[] = [
        'name' => 'volume_normalization',
        'contents' => $this->volumeNormalization ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

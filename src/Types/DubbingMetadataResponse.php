<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Date;
use DateTime;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DubbingMetadataResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The ID of the dubbing project.
   */
  #[JsonProperty('dubbing_id', required: true)]
  public string $dubbingId;

  /**
   * The name of the dubbing project.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The state this dub is in.
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * Once dubbing has completed, the ISO-639-1 code of the original media's source language.
   */
  #[JsonProperty('source_language', required: true)]
  public ?string $sourceLanguage;

  /**
   * @var string[]
   * The ISO-639-1 code of the languages this media has been dubbed into.
   */
  #[JsonProperty('target_languages', required: true), ArrayType(['string'])]
  public array $targetLanguages;

  /**
   * Whether this dubbing project is editable in Dubbing Studio.
   */
  #[JsonProperty('editable')]
  public ?bool $editable;

  /**
   * Timestamp this dub was created.
   */
  #[JsonProperty('created_at', required: true), Date(Date::TYPE_DATETIME)]
  public DateTime $createdAt;

  /**
   * Metadata, such as the length in seconds and content type, of the dubbed content.
   */
  #[JsonProperty('media_metadata')]
  public ?\ElevenLabs\Types\DubbingMediaMetadata $mediaMetadata;

  /**
   * Error message indicate, if this dub has failed, what happened.
   */
  #[JsonProperty('error')]
  public ?string $error;

  /**
   * @param array{
   *   dubbingId: string,
   *   name: string,
   *   status: string,
   *   sourceLanguage: ?string,
   *   targetLanguages: string[],
   *   createdAt: DateTime,
   *   editable?: ?bool,
   *   mediaMetadata?: ?\ElevenLabs\Types\DubbingMediaMetadata,
   *   error?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->dubbingId = $values['dubbingId'];
    $this->name = $values['name'];
    $this->status = $values['status'];
    $this->sourceLanguage = $values['sourceLanguage'];
    $this->targetLanguages = $values['targetLanguages'];
    $this->editable = $values['editable'] ?? null;
    $this->createdAt = $values['createdAt'];
    $this->mediaMetadata = $values['mediaMetadata'] ?? null;
    $this->error = $values['error'] ?? null;

    $this->_dirtyFields = [
      'dubbing_id' => true,
      'name' => true,
      'status' => true,
      'source_language' => true,
      'target_languages' => true,
      'created_at' => true
    ];
    if (array_key_exists('editable', $values)) {
      $this->_dirtyFields['editable'] = true;
    }
    if (array_key_exists('mediaMetadata', $values)) {
      $this->_dirtyFields['media_metadata'] = true;
    }
    if (array_key_exists('error', $values)) {
      $this->_dirtyFields['error'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'dubbing_id',
      'contents' => $this->dubbingId
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    $parts[] = [
      'name' => 'source_language',
      'contents' => $this->sourceLanguage
    ];

    foreach ($this->targetLanguages as $item) {
      $parts[] = [
        'name' => 'target_languages',
        'contents' => $item
      ];
    }

    if ($this->editable !== null) {
      $parts[] = [
        'name' => 'editable',
        'contents' => $this->editable ? 'true' : 'false'
      ];
    }

    $parts[] = [
      'name' => 'created_at',
      'contents' => $this->createdAt
    ];

    if ($this->mediaMetadata !== null) {
      $parts[] = [
        'name' => 'media_metadata',
        'contents' => json_encode($this->mediaMetadata),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->error !== null) {
      $parts[] = [
        'name' => 'error',
        'contents' => $this->error
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->mediaMetadata?->validate();
  }
}

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
class DubbingLanguageListResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\DubbingLanguageResponse[]
   * The page of language targets for the project.
   */
  #[
    JsonProperty('languages', required: true),
    ArrayType([\ElevenLabs\Types\DubbingLanguageResponse::class])
  ]
  public array $languages;

  /**
   * Opaque cursor to pass back as `cursor` for the next page, or null when there are no more results.
   */
  #[JsonProperty('next_cursor')]
  public ?string $nextCursor;

  /**
   * @param array{
   *   languages: \ElevenLabs\Types\DubbingLanguageResponse[],
   *   nextCursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->languages = $values['languages'];
    $this->nextCursor = $values['nextCursor'] ?? null;

    $this->_dirtyFields = [
      'languages' => true
    ];
    if (array_key_exists('nextCursor', $values)) {
      $this->_dirtyFields['next_cursor'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'languages',
      'contents' => json_encode($this->languages),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->nextCursor !== null) {
      $parts[] = [
        'name' => 'next_cursor',
        'contents' => $this->nextCursor
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->languages as $item) {
      $item->validate();
    }
  }
}

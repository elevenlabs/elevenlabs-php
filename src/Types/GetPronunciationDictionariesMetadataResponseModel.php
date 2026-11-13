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
class GetPronunciationDictionariesMetadataResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\GetPronunciationDictionaryMetadataResponse[]
   * A list of pronunciation dictionaries and their metadata.
   */
  #[
    JsonProperty('pronunciation_dictionaries', required: true),
    ArrayType([\ElevenLabs\Types\GetPronunciationDictionaryMetadataResponse::class])
  ]
  public array $pronunciationDictionaries;

  /**
   * The next cursor to use for pagination.
   */
  #[JsonProperty('next_cursor')]
  public ?string $nextCursor;

  /**
   * Whether there are more pronunciation dictionaries to fetch.
   */
  #[JsonProperty('has_more', required: true)]
  public bool $hasMore;

  /**
   * @param array{
   *   pronunciationDictionaries: \ElevenLabs\Types\GetPronunciationDictionaryMetadataResponse[],
   *   hasMore: bool,
   *   nextCursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->pronunciationDictionaries = $values['pronunciationDictionaries'];
    $this->nextCursor = $values['nextCursor'] ?? null;
    $this->hasMore = $values['hasMore'];

    $this->_dirtyFields = [
      'pronunciation_dictionaries' => true,
      'has_more' => true
    ];
    if (array_key_exists('nextCursor', $values)) {
      $this->_dirtyFields['next_cursor'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'pronunciation_dictionaries',
      'contents' => json_encode($this->pronunciationDictionaries),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->nextCursor !== null) {
      $parts[] = [
        'name' => 'next_cursor',
        'contents' => $this->nextCursor
      ];
    }

    $parts[] = [
      'name' => 'has_more',
      'contents' => $this->hasMore ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->pronunciationDictionaries as $item) {
      $item->validate();
    }
  }
}

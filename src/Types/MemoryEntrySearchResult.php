<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\Union;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class MemoryEntrySearchResult extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('entry_id', required: true)]
  public string $entryId;

  #[JsonProperty('version', required: true)]
  public int $version;

  #[JsonProperty('summary')]
  public ?string $summary;

  #[JsonProperty('text')]
  public ?string $text;

  #[
    JsonProperty('source'),
    Union(
      \ElevenLabs\Types\ConversationSource::class,
      \ElevenLabs\Types\ManualSource::class,
      'null'
    )
  ]
  public \ElevenLabs\Types\ConversationSource|\ElevenLabs\Types\ManualSource|null $source;

  /**
   * @param array{
   *   entryId: string,
   *   version: int,
   *   summary?: ?string,
   *   text?: ?string,
   *   source?: \ElevenLabs\Types\ConversationSource|\ElevenLabs\Types\ManualSource|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->entryId = $values['entryId'];
    $this->version = $values['version'];
    $this->summary = $values['summary'] ?? null;
    $this->text = $values['text'] ?? null;
    $this->source = $values['source'] ?? null;

    $this->_dirtyFields = [
      'entry_id' => true,
      'version' => true
    ];
    if (array_key_exists('summary', $values)) {
      $this->_dirtyFields['summary'] = true;
    }
    if (array_key_exists('text', $values)) {
      $this->_dirtyFields['text'] = true;
    }
    if (array_key_exists('source', $values)) {
      $this->_dirtyFields['source'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'entry_id',
      'contents' => $this->entryId
    ];

    $parts[] = [
      'name' => 'version',
      'contents' => (string) $this->version
    ];

    if ($this->summary !== null) {
      $parts[] = [
        'name' => 'summary',
        'contents' => $this->summary
      ];
    }

    if ($this->text !== null) {
      $parts[] = [
        'name' => 'text',
        'contents' => $this->text
      ];
    }

    if ($this->source !== null) {
      $parts[] = [
        'name' => 'source',
        'contents' => json_encode($this->source),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

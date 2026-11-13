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
class GetSpeechHistoryResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\SpeechHistoryItemResponse[]
   * A list of speech history items.
   */
  #[
    JsonProperty('history', required: true),
    ArrayType([\ElevenLabs\Types\SpeechHistoryItemResponse::class])
  ]
  public array $history;

  /**
   * The ID of the last history item.
   */
  #[JsonProperty('last_history_item_id')]
  public ?string $lastHistoryItemId;

  /**
   * Whether there are more history items to fetch.
   */
  #[JsonProperty('has_more', required: true)]
  public bool $hasMore;

  /**
   * The timestamp of the last history item.
   */
  #[JsonProperty('scanned_until')]
  public ?int $scannedUntil;

  /**
   * @param array{
   *   history: \ElevenLabs\Types\SpeechHistoryItemResponse[],
   *   hasMore: bool,
   *   lastHistoryItemId?: ?string,
   *   scannedUntil?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->history = $values['history'];
    $this->lastHistoryItemId = $values['lastHistoryItemId'] ?? null;
    $this->hasMore = $values['hasMore'];
    $this->scannedUntil = $values['scannedUntil'] ?? null;

    $this->_dirtyFields = [
      'history' => true,
      'has_more' => true
    ];
    if (array_key_exists('lastHistoryItemId', $values)) {
      $this->_dirtyFields['last_history_item_id'] = true;
    }
    if (array_key_exists('scannedUntil', $values)) {
      $this->_dirtyFields['scanned_until'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'history',
      'contents' => json_encode($this->history),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->lastHistoryItemId !== null) {
      $parts[] = [
        'name' => 'last_history_item_id',
        'contents' => $this->lastHistoryItemId
      ];
    }

    $parts[] = [
      'name' => 'has_more',
      'contents' => $this->hasMore ? 'true' : 'false'
    ];

    if ($this->scannedUntil !== null) {
      $parts[] = [
        'name' => 'scanned_until',
        'contents' => (string) $this->scannedUntil
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->history as $item) {
      $item->validate();
    }
  }
}

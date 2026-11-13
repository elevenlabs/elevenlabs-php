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
class GetSipLogMessagesResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\SipLogMessage[]
   */
  #[
    JsonProperty('sip_messages', required: true),
    ArrayType([\ElevenLabs\Types\SipLogMessage::class])
  ]
  public array $sipMessages;

  #[JsonProperty('next_cursor')]
  public ?string $nextCursor;

  #[JsonProperty('has_more')]
  public ?bool $hasMore;

  /**
   * @param array{
   *   sipMessages: \ElevenLabs\Types\SipLogMessage[],
   *   nextCursor?: ?string,
   *   hasMore?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->sipMessages = $values['sipMessages'];
    $this->nextCursor = $values['nextCursor'] ?? null;
    $this->hasMore = $values['hasMore'] ?? null;

    $this->_dirtyFields = [
      'sip_messages' => true
    ];
    if (array_key_exists('nextCursor', $values)) {
      $this->_dirtyFields['next_cursor'] = true;
    }
    if (array_key_exists('hasMore', $values)) {
      $this->_dirtyFields['has_more'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'sip_messages',
      'contents' => json_encode($this->sipMessages),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->nextCursor !== null) {
      $parts[] = [
        'name' => 'next_cursor',
        'contents' => $this->nextCursor
      ];
    }

    if ($this->hasMore !== null) {
      $parts[] = [
        'name' => 'has_more',
        'contents' => $this->hasMore ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->sipMessages as $item) {
      $item->validate();
    }
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WhatsAppOutboundCallResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('success', required: true)]
  public bool $success;

  #[JsonProperty('message', required: true)]
  public string $message;

  #[JsonProperty('conversation_id', required: true)]
  public ?string $conversationId;

  /**
   * @param array{
   *   success: bool,
   *   message: string,
   *   conversationId: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->success = $values['success'];
    $this->message = $values['message'];
    $this->conversationId = $values['conversationId'];

    $this->_dirtyFields = [
      'success' => true,
      'message' => true,
      'conversation_id' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'success',
      'contents' => $this->success ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'message',
      'contents' => $this->message
    ];

    $parts[] = [
      'name' => 'conversation_id',
      'contents' => $this->conversationId
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

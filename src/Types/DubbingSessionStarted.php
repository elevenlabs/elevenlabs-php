<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DubbingSessionStarted extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\DubbingSessionStartedMessageType>
   */
  #[JsonProperty('message_type', required: true)]
  public string $messageType;

  #[JsonProperty('session_id', required: true)]
  public string $sessionId;

  #[JsonProperty('client_session_id')]
  public ?string $clientSessionId;

  /**
   * @param array{
   *   messageType: value-of<\ElevenLabs\Types\DubbingSessionStartedMessageType>,
   *   sessionId: string,
   *   clientSessionId?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->messageType = $values['messageType'];
    $this->sessionId = $values['sessionId'];
    $this->clientSessionId = $values['clientSessionId'] ?? null;

    $this->_dirtyFields = [
      'message_type' => true,
      'session_id' => true
    ];
    if (array_key_exists('clientSessionId', $values)) {
      $this->_dirtyFields['client_session_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'message_type',
      'contents' => $this->messageType
    ];

    $parts[] = [
      'name' => 'session_id',
      'contents' => $this->sessionId
    ];

    if ($this->clientSessionId !== null) {
      $parts[] = [
        'name' => 'client_session_id',
        'contents' => $this->clientSessionId
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->sessionId, 'session_id', minLength: 1);
  }
}

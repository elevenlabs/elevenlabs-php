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
class SessionStarted extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\SessionStartedMessageType>
   */
  #[JsonProperty('message_type')]
  public ?string $messageType;

  #[JsonProperty('session_id', required: true)]
  public string $sessionId;

  #[JsonProperty('config', required: true)]
  public \ElevenLabs\Types\SessionStartedConfig $config;

  /**
   * @param array{
   *   sessionId: string,
   *   config: \ElevenLabs\Types\SessionStartedConfig,
   *   messageType?: ?value-of<\ElevenLabs\Types\SessionStartedMessageType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->messageType = $values['messageType'] ?? 'session_started';
    $this->sessionId = $values['sessionId'];
    $this->config = $values['config'];

    $this->_dirtyFields = [
      'session_id' => true,
      'config' => true
    ];
    if (array_key_exists('messageType', $values)) {
      $this->_dirtyFields['message_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->messageType !== null) {
      $parts[] = [
        'name' => 'message_type',
        'contents' => $this->messageType
      ];
    }

    $parts[] = [
      'name' => 'session_id',
      'contents' => $this->sessionId
    ];

    $parts[] = [
      'name' => 'config',
      'contents' => json_encode($this->config),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->config->validate();
  }
}

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
class ClientError extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('error_event', required: true)]
  public \ElevenLabs\Types\ClientErrorErrorEvent $errorEvent;

  /**
   * @var ?value-of<\ElevenLabs\Types\ClientErrorType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   errorEvent: \ElevenLabs\Types\ClientErrorErrorEvent,
   *   type?: ?value-of<\ElevenLabs\Types\ClientErrorType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->errorEvent = $values['errorEvent'];
    $this->type = $values['type'] ?? 'client_error';

    $this->_dirtyFields = [
      'error_event' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'error_event',
      'contents' => json_encode($this->errorEvent),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->errorEvent->validate();
  }
}

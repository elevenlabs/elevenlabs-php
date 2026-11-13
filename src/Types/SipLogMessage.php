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
class SipLogMessage extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('call_id', required: true)]
  public string $callId;

  /**
   * @var string[]
   */
  #[JsonProperty('phone_numbers', required: true), ArrayType(['string'])]
  public array $phoneNumbers;

  #[JsonProperty('local_address', required: true)]
  public string $localAddress;

  #[JsonProperty('remote_address', required: true)]
  public string $remoteAddress;

  #[JsonProperty('transport', required: true)]
  public string $transport;

  #[JsonProperty('raw_message', required: true)]
  public string $rawMessage;

  #[JsonProperty('error_message', required: true)]
  public string $errorMessage;

  /**
   * @var value-of<\ElevenLabs\Types\SipLogMessageDirection>
   */
  #[JsonProperty('direction', required: true)]
  public string $direction;

  #[JsonProperty('created_at_unix_micro', required: true)]
  public int $createdAtUnixMicro;

  /**
   * @param array{
   *   callId: string,
   *   phoneNumbers: string[],
   *   localAddress: string,
   *   remoteAddress: string,
   *   transport: string,
   *   rawMessage: string,
   *   errorMessage: string,
   *   direction: value-of<\ElevenLabs\Types\SipLogMessageDirection>,
   *   createdAtUnixMicro: int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->callId = $values['callId'];
    $this->phoneNumbers = $values['phoneNumbers'];
    $this->localAddress = $values['localAddress'];
    $this->remoteAddress = $values['remoteAddress'];
    $this->transport = $values['transport'];
    $this->rawMessage = $values['rawMessage'];
    $this->errorMessage = $values['errorMessage'];
    $this->direction = $values['direction'];
    $this->createdAtUnixMicro = $values['createdAtUnixMicro'];

    $this->_dirtyFields = [
      'call_id' => true,
      'phone_numbers' => true,
      'local_address' => true,
      'remote_address' => true,
      'transport' => true,
      'raw_message' => true,
      'error_message' => true,
      'direction' => true,
      'created_at_unix_micro' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'call_id',
      'contents' => $this->callId
    ];

    foreach ($this->phoneNumbers as $item) {
      $parts[] = [
        'name' => 'phone_numbers',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'local_address',
      'contents' => $this->localAddress
    ];

    $parts[] = [
      'name' => 'remote_address',
      'contents' => $this->remoteAddress
    ];

    $parts[] = [
      'name' => 'transport',
      'contents' => $this->transport
    ];

    $parts[] = [
      'name' => 'raw_message',
      'contents' => $this->rawMessage
    ];

    $parts[] = [
      'name' => 'error_message',
      'contents' => $this->errorMessage
    ];

    $parts[] = [
      'name' => 'direction',
      'contents' => $this->direction
    ];

    $parts[] = [
      'name' => 'created_at_unix_micro',
      'contents' => (string) $this->createdAtUnixMicro
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

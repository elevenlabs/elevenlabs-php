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
class SipColdConferenceTransferConfigOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('transfer_destination', required: true)]
  public \ElevenLabs\Types\SipColdConferenceTransferConfigOutputTransferDestination $transferDestination;

  /**
   * @var value-of<\ElevenLabs\Types\SipColdConferenceTransferConfigOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * @param array{
   *   transferDestination: \ElevenLabs\Types\SipColdConferenceTransferConfigOutputTransferDestination,
   *   type: value-of<\ElevenLabs\Types\SipColdConferenceTransferConfigOutputType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->transferDestination = $values['transferDestination'];
    $this->type = $values['type'];

    $this->_dirtyFields = [
      'transfer_destination' => true,
      'type' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'transfer_destination',
      'contents' => json_encode($this->transferDestination),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

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
class TwilioWarmConferenceTransferConfigOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('transfer_destination', required: true)]
  public \ElevenLabs\Types\TwilioWarmConferenceTransferConfigOutputTransferDestination $transferDestination;

  /**
   * DTMF digits to send after the call connects (e.g. 'ww1234' for an extension). Static or a dynamic variable reference. Use 'w' for a 0.5s pause.
   */
  #[JsonProperty('post_dial_digits', required: true)]
  public ?\ElevenLabs\Types\TwilioWarmConferenceTransferConfigOutputPostDialDigits $postDialDigits;

  /**
   * @var value-of<\ElevenLabs\Types\TwilioWarmConferenceTransferConfigOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  /**
   * @param array{
   *   transferDestination: \ElevenLabs\Types\TwilioWarmConferenceTransferConfigOutputTransferDestination,
   *   postDialDigits: ?\ElevenLabs\Types\TwilioWarmConferenceTransferConfigOutputPostDialDigits,
   *   type: value-of<\ElevenLabs\Types\TwilioWarmConferenceTransferConfigOutputType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->transferDestination = $values['transferDestination'];
    $this->postDialDigits = $values['postDialDigits'];
    $this->type = $values['type'];

    $this->_dirtyFields = [
      'transfer_destination' => true,
      'post_dial_digits' => true,
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
      'name' => 'post_dial_digits',
      'contents' => json_encode($this->postDialDigits),
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

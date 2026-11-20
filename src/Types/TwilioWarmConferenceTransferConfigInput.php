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
class TwilioWarmConferenceTransferConfigInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('transfer_destination', required: true)]
  public \ElevenLabs\Types\TwilioWarmConferenceTransferConfigInputTransferDestination $transferDestination;

  /**
   * DTMF digits to send after the call connects (e.g. 'ww1234' for an extension). Static or a dynamic variable reference. Use 'w' for a 0.5s pause.
   */
  #[JsonProperty('post_dial_digits')]
  public ?\ElevenLabs\Types\TwilioWarmConferenceTransferConfigInputPostDialDigits $postDialDigits;

  /**
   * @var ?value-of<\ElevenLabs\Types\TwilioWarmConferenceTransferConfigInputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @param array{
   *   transferDestination: \ElevenLabs\Types\TwilioWarmConferenceTransferConfigInputTransferDestination,
   *   postDialDigits?: ?\ElevenLabs\Types\TwilioWarmConferenceTransferConfigInputPostDialDigits,
   *   type?: ?value-of<\ElevenLabs\Types\TwilioWarmConferenceTransferConfigInputType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->transferDestination = $values['transferDestination'];
    $this->postDialDigits = $values['postDialDigits'] ?? null;
    $this->type = $values['type'] ?? 'twilio_warm_conference_transfer';

    $this->_dirtyFields = [
      'transfer_destination' => true
    ];
    if (array_key_exists('postDialDigits', $values)) {
      $this->_dirtyFields['post_dial_digits'] = true;
    }
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'transfer_destination',
      'contents' => json_encode($this->transferDestination),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->postDialDigits !== null) {
      $parts[] = [
        'name' => 'post_dial_digits',
        'contents' => json_encode($this->postDialDigits),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

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
  }
}

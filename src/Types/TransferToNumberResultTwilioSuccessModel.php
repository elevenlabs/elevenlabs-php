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
class TransferToNumberResultTwilioSuccessModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\TransferToNumberResultTwilioSuccessModelResultType>
   */
  #[JsonProperty('result_type')]
  public ?string $resultType;

  /**
   * @var ?value-of<\ElevenLabs\Types\TransferToNumberResultTwilioSuccessModelStatus>
   */
  #[JsonProperty('status')]
  public ?string $status;

  #[JsonProperty('transfer_number', required: true)]
  public string $transferNumber;

  #[JsonProperty('reason')]
  public ?string $reason;

  #[JsonProperty('client_message')]
  public ?string $clientMessage;

  #[JsonProperty('agent_message', required: true)]
  public string $agentMessage;

  #[JsonProperty('conference_name', required: true)]
  public string $conferenceName;

  #[JsonProperty('post_dial_digits')]
  public ?string $postDialDigits;

  #[JsonProperty('note')]
  public ?string $note;

  /**
   * @param array{
   *   transferNumber: string,
   *   agentMessage: string,
   *   conferenceName: string,
   *   resultType?: ?value-of<\ElevenLabs\Types\TransferToNumberResultTwilioSuccessModelResultType>,
   *   status?: ?value-of<\ElevenLabs\Types\TransferToNumberResultTwilioSuccessModelStatus>,
   *   reason?: ?string,
   *   clientMessage?: ?string,
   *   postDialDigits?: ?string,
   *   note?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->resultType = $values['resultType'] ?? 'transfer_to_number_twilio_success';
    $this->status = $values['status'] ?? 'success';
    $this->transferNumber = $values['transferNumber'];
    $this->reason = $values['reason'] ?? null;
    $this->clientMessage = $values['clientMessage'] ?? null;
    $this->agentMessage = $values['agentMessage'];
    $this->conferenceName = $values['conferenceName'];
    $this->postDialDigits = $values['postDialDigits'] ?? null;
    $this->note = $values['note'] ?? null;

    $this->_dirtyFields = [
      'transfer_number' => true,
      'agent_message' => true,
      'conference_name' => true
    ];
    if (array_key_exists('resultType', $values)) {
      $this->_dirtyFields['result_type'] = true;
    }
    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
    if (array_key_exists('reason', $values)) {
      $this->_dirtyFields['reason'] = true;
    }
    if (array_key_exists('clientMessage', $values)) {
      $this->_dirtyFields['client_message'] = true;
    }
    if (array_key_exists('postDialDigits', $values)) {
      $this->_dirtyFields['post_dial_digits'] = true;
    }
    if (array_key_exists('note', $values)) {
      $this->_dirtyFields['note'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->resultType !== null) {
      $parts[] = [
        'name' => 'result_type',
        'contents' => $this->resultType
      ];
    }

    if ($this->status !== null) {
      $parts[] = [
        'name' => 'status',
        'contents' => $this->status
      ];
    }

    $parts[] = [
      'name' => 'transfer_number',
      'contents' => $this->transferNumber
    ];

    if ($this->reason !== null) {
      $parts[] = [
        'name' => 'reason',
        'contents' => $this->reason
      ];
    }

    if ($this->clientMessage !== null) {
      $parts[] = [
        'name' => 'client_message',
        'contents' => $this->clientMessage
      ];
    }

    $parts[] = [
      'name' => 'agent_message',
      'contents' => $this->agentMessage
    ];

    $parts[] = [
      'name' => 'conference_name',
      'contents' => $this->conferenceName
    ];

    if ($this->postDialDigits !== null) {
      $parts[] = [
        'name' => 'post_dial_digits',
        'contents' => $this->postDialDigits
      ];
    }

    if ($this->note !== null) {
      $parts[] = [
        'name' => 'note',
        'contents' => $this->note
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

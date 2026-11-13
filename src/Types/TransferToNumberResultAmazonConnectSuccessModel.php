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
class TransferToNumberResultAmazonConnectSuccessModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModelResultType>
   */
  #[JsonProperty('result_type')]
  public ?string $resultType;

  /**
   * @var ?value-of<\ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModelStatus>
   */
  #[JsonProperty('status')]
  public ?string $status;

  /**
   * Why the agent escalated, as sent to Amazon Connect with the Escalate outcome.
   */
  #[JsonProperty('reason')]
  public ?string $reason;

  /**
   * Message spoken to the caller before the session was handed back to Amazon Connect.
   */
  #[JsonProperty('client_message')]
  public ?string $clientMessage;

  /**
   * Set when the agent echoed an invalid option and the only configured one was used.
   */
  #[JsonProperty('note')]
  public ?string $note;

  /**
   * @param array{
   *   resultType?: ?value-of<\ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModelResultType>,
   *   status?: ?value-of<\ElevenLabs\Types\TransferToNumberResultAmazonConnectSuccessModelStatus>,
   *   reason?: ?string,
   *   clientMessage?: ?string,
   *   note?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->resultType = $values['resultType'] ?? 'transfer_to_number_amazon_connect_success';
    $this->status = $values['status'] ?? 'success';
    $this->reason = $values['reason'] ?? null;
    $this->clientMessage = $values['clientMessage'] ?? null;
    $this->note = $values['note'] ?? null;

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

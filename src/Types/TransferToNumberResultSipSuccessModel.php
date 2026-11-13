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
class TransferToNumberResultSipSuccessModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\TransferToNumberResultSipSuccessModelResultType>
   */
  #[JsonProperty('result_type')]
  public ?string $resultType;

  /**
   * @var ?value-of<\ElevenLabs\Types\TransferToNumberResultSipSuccessModelStatus>
   */
  #[JsonProperty('status')]
  public ?string $status;

  #[JsonProperty('transfer_number', required: true)]
  public string $transferNumber;

  #[JsonProperty('reason')]
  public ?string $reason;

  #[JsonProperty('note')]
  public ?string $note;

  /**
   * @param array{
   *   transferNumber: string,
   *   resultType?: ?value-of<\ElevenLabs\Types\TransferToNumberResultSipSuccessModelResultType>,
   *   status?: ?value-of<\ElevenLabs\Types\TransferToNumberResultSipSuccessModelStatus>,
   *   reason?: ?string,
   *   note?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->resultType = $values['resultType'] ?? 'transfer_to_number_sip_success';
    $this->status = $values['status'] ?? 'success';
    $this->transferNumber = $values['transferNumber'];
    $this->reason = $values['reason'] ?? null;
    $this->note = $values['note'] ?? null;

    $this->_dirtyFields = [
      'transfer_number' => true
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

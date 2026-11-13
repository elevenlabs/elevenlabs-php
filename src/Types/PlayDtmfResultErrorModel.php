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
class PlayDtmfResultErrorModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\PlayDtmfResultErrorModelResultType>
   */
  #[JsonProperty('result_type')]
  public ?string $resultType;

  /**
   * @var ?value-of<\ElevenLabs\Types\PlayDtmfResultErrorModelStatus>
   */
  #[JsonProperty('status')]
  public ?string $status;

  #[JsonProperty('error', required: true)]
  public string $error;

  #[JsonProperty('details')]
  public ?string $details;

  /**
   * @param array{
   *   error: string,
   *   resultType?: ?value-of<\ElevenLabs\Types\PlayDtmfResultErrorModelResultType>,
   *   status?: ?value-of<\ElevenLabs\Types\PlayDtmfResultErrorModelStatus>,
   *   details?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->resultType = $values['resultType'] ?? 'play_dtmf_error';
    $this->status = $values['status'] ?? 'error';
    $this->error = $values['error'];
    $this->details = $values['details'] ?? null;

    $this->_dirtyFields = [
      'error' => true
    ];
    if (array_key_exists('resultType', $values)) {
      $this->_dirtyFields['result_type'] = true;
    }
    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
    if (array_key_exists('details', $values)) {
      $this->_dirtyFields['details'] = true;
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
      'name' => 'error',
      'contents' => $this->error
    ];

    if ($this->details !== null) {
      $parts[] = [
        'name' => 'details',
        'contents' => $this->details
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}

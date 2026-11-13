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
class SkipTurnToolResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\SkipTurnToolResponseModelResultType>
   */
  #[JsonProperty('result_type')]
  public ?string $resultType;

  /**
   * @var ?value-of<\ElevenLabs\Types\SkipTurnToolResponseModelStatus>
   */
  #[JsonProperty('status')]
  public ?string $status;

  #[JsonProperty('reason')]
  public ?string $reason;

  /**
   * @param array{
   *   resultType?: ?value-of<\ElevenLabs\Types\SkipTurnToolResponseModelResultType>,
   *   status?: ?value-of<\ElevenLabs\Types\SkipTurnToolResponseModelStatus>,
   *   reason?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->resultType = $values['resultType'] ?? 'skip_turn_success';
    $this->status = $values['status'] ?? 'success';
    $this->reason = $values['reason'] ?? null;

    if (array_key_exists('resultType', $values)) {
      $this->_dirtyFields['result_type'] = true;
    }
    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
    }
    if (array_key_exists('reason', $values)) {
      $this->_dirtyFields['reason'] = true;
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

    return $parts;
  }

  public function validate(): void
  {
  }
}

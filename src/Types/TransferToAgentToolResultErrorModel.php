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
class TransferToAgentToolResultErrorModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\TransferToAgentToolResultErrorModelResultType>
   */
  #[JsonProperty('result_type')]
  public ?string $resultType;

  /**
   * @var ?value-of<\ElevenLabs\Types\TransferToAgentToolResultErrorModelStatus>
   */
  #[JsonProperty('status')]
  public ?string $status;

  #[JsonProperty('from_agent', required: true)]
  public string $fromAgent;

  #[JsonProperty('error', required: true)]
  public string $error;

  /**
   * @param array{
   *   fromAgent: string,
   *   error: string,
   *   resultType?: ?value-of<\ElevenLabs\Types\TransferToAgentToolResultErrorModelResultType>,
   *   status?: ?value-of<\ElevenLabs\Types\TransferToAgentToolResultErrorModelStatus>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->resultType = $values['resultType'] ?? 'transfer_to_agent_error';
    $this->status = $values['status'] ?? 'error';
    $this->fromAgent = $values['fromAgent'];
    $this->error = $values['error'];

    $this->_dirtyFields = [
      'from_agent' => true,
      'error' => true
    ];
    if (array_key_exists('resultType', $values)) {
      $this->_dirtyFields['result_type'] = true;
    }
    if (array_key_exists('status', $values)) {
      $this->_dirtyFields['status'] = true;
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
      'name' => 'from_agent',
      'contents' => $this->fromAgent
    ];

    $parts[] = [
      'name' => 'error',
      'contents' => $this->error
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}

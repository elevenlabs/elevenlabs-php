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
class AgentSummaryBatchSuccessfulResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AgentSummaryBatchSuccessfulResponseModelStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  #[JsonProperty('data', required: true)]
  public \ElevenLabs\Types\AgentSummaryResponseModel $data;

  /**
   * @param array{
   *   status: value-of<\ElevenLabs\Types\AgentSummaryBatchSuccessfulResponseModelStatus>,
   *   data: \ElevenLabs\Types\AgentSummaryResponseModel,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->status = $values['status'];
    $this->data = $values['data'];

    $this->_dirtyFields = [
      'status' => true,
      'data' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    $parts[] = [
      'name' => 'data',
      'contents' => json_encode($this->data),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->data->validate();
  }
}

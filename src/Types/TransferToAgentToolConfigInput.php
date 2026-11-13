<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TransferToAgentToolConfigInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\TransferToAgentToolConfigInputSystemToolType>
   */
  #[JsonProperty('system_tool_type')]
  public ?string $systemToolType;

  /**
   * @var \ElevenLabs\Types\AgentTransferInput[]
   */
  #[
    JsonProperty('transfers', required: true),
    ArrayType([\ElevenLabs\Types\AgentTransferInput::class])
  ]
  public array $transfers;

  /**
   * @param array{
   *   transfers: \ElevenLabs\Types\AgentTransferInput[],
   *   systemToolType?: ?value-of<\ElevenLabs\Types\TransferToAgentToolConfigInputSystemToolType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->systemToolType = $values['systemToolType'] ?? 'transfer_to_agent';
    $this->transfers = $values['transfers'];

    $this->_dirtyFields = [
      'transfers' => true
    ];
    if (array_key_exists('systemToolType', $values)) {
      $this->_dirtyFields['system_tool_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->systemToolType !== null) {
      $parts[] = [
        'name' => 'system_tool_type',
        'contents' => $this->systemToolType
      ];
    }

    $parts[] = [
      'name' => 'transfers',
      'contents' => json_encode($this->transfers),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->transfers as $item) {
      $item->validate();
    }
  }
}

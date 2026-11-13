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
class TransferToNumberToolConfigOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\TransferToNumberToolConfigOutputSystemToolType>
   */
  #[JsonProperty('system_tool_type')]
  public ?string $systemToolType;

  /**
   * @var \ElevenLabs\Types\PhoneNumberTransfer[]
   */
  #[
    JsonProperty('transfers', required: true),
    ArrayType([\ElevenLabs\Types\PhoneNumberTransfer::class])
  ]
  public array $transfers;

  /**
   * Whether to play a message to the client while they wait for transfer. Defaults to true for backward compatibility.
   */
  #[JsonProperty('enable_client_message')]
  public ?bool $enableClientMessage;

  /**
   * @param array{
   *   transfers: \ElevenLabs\Types\PhoneNumberTransfer[],
   *   systemToolType?: ?value-of<\ElevenLabs\Types\TransferToNumberToolConfigOutputSystemToolType>,
   *   enableClientMessage?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->systemToolType = $values['systemToolType'] ?? 'transfer_to_number';
    $this->transfers = $values['transfers'];
    $this->enableClientMessage = $values['enableClientMessage'] ?? null;

    $this->_dirtyFields = [
      'transfers' => true
    ];
    if (array_key_exists('systemToolType', $values)) {
      $this->_dirtyFields['system_tool_type'] = true;
    }
    if (array_key_exists('enableClientMessage', $values)) {
      $this->_dirtyFields['enable_client_message'] = true;
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

    if ($this->enableClientMessage !== null) {
      $parts[] = [
        'name' => 'enable_client_message',
        'contents' => $this->enableClientMessage ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->transfers as $item) {
      $item->validate();
    }
  }
}

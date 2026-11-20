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
class StreamEndedData extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AgentOutputStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  #[JsonProperty('error')]
  public ?\ElevenLabs\Types\AgentOutputError $error;

  /**
   * @var \ElevenLabs\Types\ClientToolCallRequiredAction[]|null
   * The actions the agent waits on. Answer each `client_tool_call` with a `client_tool_result` item in `input` to continue.
   */
  #[
    JsonProperty('required_actions'),
    ArrayType([\ElevenLabs\Types\ClientToolCallRequiredAction::class])
  ]
  public ?array $requiredActions;

  /**
   * @param array{
   *   status: value-of<\ElevenLabs\Types\AgentOutputStatus>,
   *   error?: ?\ElevenLabs\Types\AgentOutputError,
   *   requiredActions?: \ElevenLabs\Types\ClientToolCallRequiredAction[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->status = $values['status'];
    $this->error = $values['error'] ?? null;
    $this->requiredActions = $values['requiredActions'] ?? null;

    $this->_dirtyFields = [
      'status' => true
    ];
    if (array_key_exists('error', $values)) {
      $this->_dirtyFields['error'] = true;
    }
    if (array_key_exists('requiredActions', $values)) {
      $this->_dirtyFields['required_actions'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    if ($this->error !== null) {
      $parts[] = [
        'name' => 'error',
        'contents' => json_encode($this->error),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->requiredActions !== null) {
      $parts[] = [
        'name' => 'required_actions',
        'contents' => json_encode($this->requiredActions),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->error?->validate();
    foreach ($this->requiredActions ?? [] as $item) {
      $item->validate();
    }
  }
}

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
class ConversationTurn extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('turn_id', required: true)]
  public string $turnId;

  /**
   * @var value-of<\ElevenLabs\Types\AgentOutputStatus>
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * @var \ElevenLabs\Types\TextOutputItem[]|null
   */
  #[JsonProperty('output'), ArrayType([\ElevenLabs\Types\TextOutputItem::class])]
  public ?array $output;

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
   * Resume token for this turn's event stream. Present while the turn is in progress; pass it as Last-Event-ID to stream the turn's events.
   */
  #[JsonProperty('stream_cursor')]
  public ?string $streamCursor;

  /**
   * @param array{
   *   turnId: string,
   *   status: value-of<\ElevenLabs\Types\AgentOutputStatus>,
   *   output?: \ElevenLabs\Types\TextOutputItem[]|null,
   *   error?: ?\ElevenLabs\Types\AgentOutputError,
   *   requiredActions?: \ElevenLabs\Types\ClientToolCallRequiredAction[]|null,
   *   streamCursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->turnId = $values['turnId'];
    $this->status = $values['status'];
    $this->output = $values['output'] ?? null;
    $this->error = $values['error'] ?? null;
    $this->requiredActions = $values['requiredActions'] ?? null;
    $this->streamCursor = $values['streamCursor'] ?? null;

    $this->_dirtyFields = [
      'turn_id' => true,
      'status' => true
    ];
    if (array_key_exists('output', $values)) {
      $this->_dirtyFields['output'] = true;
    }
    if (array_key_exists('error', $values)) {
      $this->_dirtyFields['error'] = true;
    }
    if (array_key_exists('requiredActions', $values)) {
      $this->_dirtyFields['required_actions'] = true;
    }
    if (array_key_exists('streamCursor', $values)) {
      $this->_dirtyFields['stream_cursor'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'turn_id',
      'contents' => $this->turnId
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    if ($this->output !== null) {
      $parts[] = [
        'name' => 'output',
        'contents' => json_encode($this->output),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

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

    if ($this->streamCursor !== null) {
      $parts[] = [
        'name' => 'stream_cursor',
        'contents' => $this->streamCursor
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->output ?? [] as $item) {
      $item->validate();
    }
    $this->error?->validate();
    foreach ($this->requiredActions ?? [] as $item) {
      $item->validate();
    }
  }
}

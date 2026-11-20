<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;

/**
 * Discriminated union type (oneOf) representing exactly one of multiple possible types.
 *
 * This class implements a type-safe union where the value can be exactly one of the
 * defined variant types. It provides factory methods for construction, type-checking
 * methods, safe and throwing getters, and pattern matching for exhaustive handling.
 *
 * The oneOf pattern enforces that only one type can be present at a time, unlike anyOf
 * which allows multiple types simultaneously.
 */
class StreamEnvelopeEvent extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\StreamEndedEvent|\ElevenLabs\Types\AgentChatResponsePartClientEvent|\ElevenLabs\Types\AgentReasoningResponsePartClientEvent|\ElevenLabs\Types\AgentResponseClientEvent|\ElevenLabs\Types\AgentToolRequestStreamedEvent|\ElevenLabs\Types\AgentToolResponseStreamedEvent|\ElevenLabs\Types\ClientToolCallEvent|array<string, mixed> The value, exactly one of the variant types
   */
  public readonly mixed $value;

  /**
   * @var int The type index identifying which variant type is stored
   */
  private int $typeIndex;

  /** The type index of a payload whose discriminator names no variant this SDK knows. */
  private const UNKNOWN = -1;

  /**
   * Whether the payload's discriminator named a variant this SDK does not know (a variant added to
   * the API after this SDK was generated). Its raw payload is kept, as Fern's `_unknown` variant does.
   *
   * Underscore-prefixed because a union may legitimately have a variant NAMED `unknown`, whose own
   * accessors are `isUnknown()`/`asUnknown()`. Declaring both is a fatal `Cannot redeclare` and the
   * class cannot load at all. The prefix matches Fern's `_unknown` sentinel and Java's
   * `_isUnknown()`/`_getUnknown()`, and a variant accessor is always `isX`/`asX`, never `_isX` --
   * so the two can never collide whatever a spec calls its variants.
   */
  public function _isUnknown(): bool
  {
    return $this->typeIndex === self::UNKNOWN;
  }

  /**
   * @return array<string, mixed> The raw payload of an unknown variant
   * @throws \RuntimeException if this StreamEnvelopeEvent holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('StreamEnvelopeEvent does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\StreamEndedEvent|\ElevenLabs\Types\AgentChatResponsePartClientEvent|\ElevenLabs\Types\AgentReasoningResponsePartClientEvent|\ElevenLabs\Types\AgentResponseClientEvent|\ElevenLabs\Types\AgentToolRequestStreamedEvent|\ElevenLabs\Types\AgentToolResponseStreamedEvent|\ElevenLabs\Types\ClientToolCallEvent|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'stream_ended',
      1 => 'agent_chat_response_part',
      2 => 'agent_reasoning_response_part',
      3 => 'agent_response',
      4 => 'agent_tool_request',
      5 => 'agent_tool_response',
      6 => 'client_tool_call',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a StreamEnvelopeEvent instance containing a \ElevenLabs\Types\StreamEndedEvent
   */
  public static function streamEnded(\ElevenLabs\Types\StreamEndedEvent $streamEnded): self
  {
    return new self($streamEnded, 0);
  }

  /**
   * Create a StreamEnvelopeEvent instance containing a \ElevenLabs\Types\AgentChatResponsePartClientEvent
   */
  public static function agentChatResponsePart(
    \ElevenLabs\Types\AgentChatResponsePartClientEvent $agentChatResponsePart
  ): self {
    return new self($agentChatResponsePart, 1);
  }

  /**
   * Create a StreamEnvelopeEvent instance containing a \ElevenLabs\Types\AgentReasoningResponsePartClientEvent
   */
  public static function agentReasoningResponsePart(
    \ElevenLabs\Types\AgentReasoningResponsePartClientEvent $agentReasoningResponsePart
  ): self {
    return new self($agentReasoningResponsePart, 2);
  }

  /**
   * Create a StreamEnvelopeEvent instance containing a \ElevenLabs\Types\AgentResponseClientEvent
   */
  public static function agentResponse(
    \ElevenLabs\Types\AgentResponseClientEvent $agentResponse
  ): self {
    return new self($agentResponse, 3);
  }

  /**
   * Create a StreamEnvelopeEvent instance containing a \ElevenLabs\Types\AgentToolRequestStreamedEvent
   */
  public static function agentToolRequest(
    \ElevenLabs\Types\AgentToolRequestStreamedEvent $agentToolRequest
  ): self {
    return new self($agentToolRequest, 4);
  }

  /**
   * Create a StreamEnvelopeEvent instance containing a \ElevenLabs\Types\AgentToolResponseStreamedEvent
   */
  public static function agentToolResponse(
    \ElevenLabs\Types\AgentToolResponseStreamedEvent $agentToolResponse
  ): self {
    return new self($agentToolResponse, 5);
  }

  /**
   * Create a StreamEnvelopeEvent instance containing a \ElevenLabs\Types\ClientToolCallEvent
   */
  public static function clientToolCall(\ElevenLabs\Types\ClientToolCallEvent $clientToolCall): self
  {
    return new self($clientToolCall, 6);
  }

  // Type checking methods
  /**
   * Check if this StreamEnvelopeEvent contains a \ElevenLabs\Types\StreamEndedEvent
   */
  public function isStreamEnded(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this StreamEnvelopeEvent contains a \ElevenLabs\Types\AgentChatResponsePartClientEvent
   */
  public function isAgentChatResponsePart(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this StreamEnvelopeEvent contains a \ElevenLabs\Types\AgentReasoningResponsePartClientEvent
   */
  public function isAgentReasoningResponsePart(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this StreamEnvelopeEvent contains a \ElevenLabs\Types\AgentResponseClientEvent
   */
  public function isAgentResponse(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this StreamEnvelopeEvent contains a \ElevenLabs\Types\AgentToolRequestStreamedEvent
   */
  public function isAgentToolRequest(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this StreamEnvelopeEvent contains a \ElevenLabs\Types\AgentToolResponseStreamedEvent
   */
  public function isAgentToolResponse(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this StreamEnvelopeEvent contains a \ElevenLabs\Types\ClientToolCallEvent
   */
  public function isClientToolCall(): bool
  {
    return $this->typeIndex === 6;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\StreamEndedEvent value
   * @throws \RuntimeException if this StreamEnvelopeEvent does not contain a \ElevenLabs\Types\StreamEndedEvent
   */
  public function asStreamEnded(): \ElevenLabs\Types\StreamEndedEvent
  {
    if (!$this->isStreamEnded()) {
      throw new \RuntimeException(
        'StreamEnvelopeEvent does not contain \ElevenLabs\Types\StreamEndedEvent'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AgentChatResponsePartClientEvent value
   * @throws \RuntimeException if this StreamEnvelopeEvent does not contain a \ElevenLabs\Types\AgentChatResponsePartClientEvent
   */
  public function asAgentChatResponsePart(): \ElevenLabs\Types\AgentChatResponsePartClientEvent
  {
    if (!$this->isAgentChatResponsePart()) {
      throw new \RuntimeException(
        'StreamEnvelopeEvent does not contain \ElevenLabs\Types\AgentChatResponsePartClientEvent'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AgentReasoningResponsePartClientEvent value
   * @throws \RuntimeException if this StreamEnvelopeEvent does not contain a \ElevenLabs\Types\AgentReasoningResponsePartClientEvent
   */
  public function asAgentReasoningResponsePart(): \ElevenLabs\Types\AgentReasoningResponsePartClientEvent
  {
    if (!$this->isAgentReasoningResponsePart()) {
      throw new \RuntimeException(
        'StreamEnvelopeEvent does not contain \ElevenLabs\Types\AgentReasoningResponsePartClientEvent'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AgentResponseClientEvent value
   * @throws \RuntimeException if this StreamEnvelopeEvent does not contain a \ElevenLabs\Types\AgentResponseClientEvent
   */
  public function asAgentResponse(): \ElevenLabs\Types\AgentResponseClientEvent
  {
    if (!$this->isAgentResponse()) {
      throw new \RuntimeException(
        'StreamEnvelopeEvent does not contain \ElevenLabs\Types\AgentResponseClientEvent'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AgentToolRequestStreamedEvent value
   * @throws \RuntimeException if this StreamEnvelopeEvent does not contain a \ElevenLabs\Types\AgentToolRequestStreamedEvent
   */
  public function asAgentToolRequest(): \ElevenLabs\Types\AgentToolRequestStreamedEvent
  {
    if (!$this->isAgentToolRequest()) {
      throw new \RuntimeException(
        'StreamEnvelopeEvent does not contain \ElevenLabs\Types\AgentToolRequestStreamedEvent'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AgentToolResponseStreamedEvent value
   * @throws \RuntimeException if this StreamEnvelopeEvent does not contain a \ElevenLabs\Types\AgentToolResponseStreamedEvent
   */
  public function asAgentToolResponse(): \ElevenLabs\Types\AgentToolResponseStreamedEvent
  {
    if (!$this->isAgentToolResponse()) {
      throw new \RuntimeException(
        'StreamEnvelopeEvent does not contain \ElevenLabs\Types\AgentToolResponseStreamedEvent'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ClientToolCallEvent value
   * @throws \RuntimeException if this StreamEnvelopeEvent does not contain a \ElevenLabs\Types\ClientToolCallEvent
   */
  public function asClientToolCall(): \ElevenLabs\Types\ClientToolCallEvent
  {
    if (!$this->isClientToolCall()) {
      throw new \RuntimeException(
        'StreamEnvelopeEvent does not contain \ElevenLabs\Types\ClientToolCallEvent'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\StreamEndedEvent value
   * @return \ElevenLabs\Types\StreamEndedEvent|null Returns the value if this StreamEnvelopeEvent contains a \ElevenLabs\Types\StreamEndedEvent, null otherwise
   */
  public function tryAsStreamEnded(): ?\ElevenLabs\Types\StreamEndedEvent
  {
    return $this->isStreamEnded() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AgentChatResponsePartClientEvent value
   * @return \ElevenLabs\Types\AgentChatResponsePartClientEvent|null Returns the value if this StreamEnvelopeEvent contains a \ElevenLabs\Types\AgentChatResponsePartClientEvent, null otherwise
   */
  public function tryAsAgentChatResponsePart(): ?\ElevenLabs\Types\AgentChatResponsePartClientEvent
  {
    return $this->isAgentChatResponsePart() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AgentReasoningResponsePartClientEvent value
   * @return \ElevenLabs\Types\AgentReasoningResponsePartClientEvent|null Returns the value if this StreamEnvelopeEvent contains a \ElevenLabs\Types\AgentReasoningResponsePartClientEvent, null otherwise
   */
  public function tryAsAgentReasoningResponsePart(): ?\ElevenLabs\Types\AgentReasoningResponsePartClientEvent
  {
    return $this->isAgentReasoningResponsePart() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AgentResponseClientEvent value
   * @return \ElevenLabs\Types\AgentResponseClientEvent|null Returns the value if this StreamEnvelopeEvent contains a \ElevenLabs\Types\AgentResponseClientEvent, null otherwise
   */
  public function tryAsAgentResponse(): ?\ElevenLabs\Types\AgentResponseClientEvent
  {
    return $this->isAgentResponse() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AgentToolRequestStreamedEvent value
   * @return \ElevenLabs\Types\AgentToolRequestStreamedEvent|null Returns the value if this StreamEnvelopeEvent contains a \ElevenLabs\Types\AgentToolRequestStreamedEvent, null otherwise
   */
  public function tryAsAgentToolRequest(): ?\ElevenLabs\Types\AgentToolRequestStreamedEvent
  {
    return $this->isAgentToolRequest() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AgentToolResponseStreamedEvent value
   * @return \ElevenLabs\Types\AgentToolResponseStreamedEvent|null Returns the value if this StreamEnvelopeEvent contains a \ElevenLabs\Types\AgentToolResponseStreamedEvent, null otherwise
   */
  public function tryAsAgentToolResponse(): ?\ElevenLabs\Types\AgentToolResponseStreamedEvent
  {
    return $this->isAgentToolResponse() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ClientToolCallEvent value
   * @return \ElevenLabs\Types\ClientToolCallEvent|null Returns the value if this StreamEnvelopeEvent contains a \ElevenLabs\Types\ClientToolCallEvent, null otherwise
   */
  public function tryAsClientToolCall(): ?\ElevenLabs\Types\ClientToolCallEvent
  {
    return $this->isClientToolCall() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\StreamEndedEvent): T $onStreamEnded
   * @param callable(\ElevenLabs\Types\AgentChatResponsePartClientEvent): T $onAgentChatResponsePart
   * @param callable(\ElevenLabs\Types\AgentReasoningResponsePartClientEvent): T $onAgentReasoningResponsePart
   * @param callable(\ElevenLabs\Types\AgentResponseClientEvent): T $onAgentResponse
   * @param callable(\ElevenLabs\Types\AgentToolRequestStreamedEvent): T $onAgentToolRequest
   * @param callable(\ElevenLabs\Types\AgentToolResponseStreamedEvent): T $onAgentToolResponse
   * @param callable(\ElevenLabs\Types\ClientToolCallEvent): T $onClientToolCall
   * @return T
   */
  public function match(
    callable $onStreamEnded,
    callable $onAgentChatResponsePart,
    callable $onAgentReasoningResponsePart,
    callable $onAgentResponse,
    callable $onAgentToolRequest,
    callable $onAgentToolResponse,
    callable $onClientToolCall
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onStreamEnded($this->value),
      1 => $onAgentChatResponsePart($this->value),
      2 => $onAgentReasoningResponsePart($this->value),
      3 => $onAgentResponse($this->value),
      4 => $onAgentToolRequest($this->value),
      5 => $onAgentToolResponse($this->value),
      6 => $onClientToolCall($this->value),
      default => throw new \UnexpectedValueException("Unknown type index: $this->typeIndex")
    };
  }

  /**
   * Deserialize from data - try each type in order
   * @param array<string, mixed> $data
   * @return self
   * @throws \InvalidArgumentException if data doesn't match any type
   */
  public static function fromArray(array $data): self
  {
    // Best-match-wins: collect every variant that fromArray() accepted,
    // score each by how many of the input keys it actually consumed
    // (looked up via the per-instance _dirtyFields populated by the
    // variant's own fromArray), then keep the highest-scoring one. Ties
    // break to the first-declared variant because PHP's usort is stable
    // when compared values are equal and we visit variants in order.
    // This is what makes oneOf with overlapping schemas (e.g. Cat & Dog
    // both have `name`, only Cat has `color`) pick the right variant
    // when discriminating fields are present.
    // The payload's own discriminator value picks the variant. Scoring alone ties whenever two
    // members have the same shape and differ only in that constant, and the first would win.
    if (is_array($data) && isset($data['type']) && is_string($data['type'])) {
      switch ($data['type']) {
        case 'agent_chat_response_part':
          return new self(\ElevenLabs\Types\AgentChatResponsePartClientEvent::fromArray($data), 1);
        case 'agent_reasoning_response_part':
          return new self(
            \ElevenLabs\Types\AgentReasoningResponsePartClientEvent::fromArray($data),
            2
          );
        case 'agent_response':
          return new self(\ElevenLabs\Types\AgentResponseClientEvent::fromArray($data), 3);
        case 'agent_tool_request':
          return new self(\ElevenLabs\Types\AgentToolRequestStreamedEvent::fromArray($data), 4);
        case 'agent_tool_response':
          return new self(\ElevenLabs\Types\AgentToolResponseStreamedEvent::fromArray($data), 5);
        case 'client_tool_call':
          return new self(\ElevenLabs\Types\ClientToolCallEvent::fromArray($data), 6);
        case 'stream_ended':
          return new self(\ElevenLabs\Types\StreamEndedEvent::fromArray($data), 0);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\StreamEndedEvent::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\StreamEndedEvent didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AgentChatResponsePartClientEvent::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AgentChatResponsePartClientEvent didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AgentReasoningResponsePartClientEvent::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AgentReasoningResponsePartClientEvent didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AgentResponseClientEvent::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AgentResponseClientEvent didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AgentToolRequestStreamedEvent::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AgentToolRequestStreamedEvent didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AgentToolResponseStreamedEvent::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AgentToolResponseStreamedEvent didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ClientToolCallEvent::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ClientToolCallEvent didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any StreamEnvelopeEvent type');
    }
    $best = $candidates[0];
    foreach ($candidates as $candidate) {
      if ($candidate['score'] > $best['score']) {
        $best = $candidate;
      }
    }
    return new self($best['instance'], $best['idx']);
  }

  /**
   * Serialize to JSON - returns the serialized inner value
   *
   * @return array<mixed>
   */
  public function jsonSerialize(): array
  {
    if ($this->_isUnknown()) {
      return $this->_asUnknown();
    }
    return $this->value->jsonSerialize();
  }
}

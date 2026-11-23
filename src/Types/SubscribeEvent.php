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
class SubscribeEvent extends JsonSerializableType
{
  /**
   * @var string The discriminator value identifying which variant is stored
   */
  public readonly string $type;

  /**
   * @var \ElevenLabs\Types\ConversationInitiationMetadata|\ElevenLabs\Types\AgentResponseComplete|\ElevenLabs\Types\ContextUsage|\ElevenLabs\Types\McpToolCall|\ElevenLabs\Types\ClientError|\ElevenLabs\Types\GuardrailTriggered|\ElevenLabs\Types\ConversationUserTranscript|\ElevenLabs\Types\ConversationAgentResponse|\ElevenLabs\Types\QueueStatus|\ElevenLabs\Types\AgentResponseCorrection|\ElevenLabs\Types\AgentResponseMetadata|\ElevenLabs\Types\AudioResponse|\ElevenLabs\Types\Interruption|\ElevenLabs\Types\VadScore|\ElevenLabs\Types\AgentChatResponsePart|\ElevenLabs\Types\ClientToolCall|\ElevenLabs\Types\AgentToolResponse|\ElevenLabs\Types\AgentToolResponseFullPayload|\ElevenLabs\Types\AgentToolRequest|\ElevenLabs\Types\ConversationPing|\ElevenLabs\Types\McpConnectionStatus|array<string, mixed> The value, exactly one of the variant types
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
   * @throws \RuntimeException if this SubscribeEvent holds a known variant
   */
  public function _asUnknown(): array
  {
    if (!$this->_isUnknown()) {
      throw new \RuntimeException('SubscribeEvent does not contain an unknown variant');
    }
    /** @var array<string, mixed> $value */
    $value = $this->value;
    return $value;
  }

  /**
   * Private constructor - use factory methods to create instances
   * @param \ElevenLabs\Types\ConversationInitiationMetadata|\ElevenLabs\Types\AgentResponseComplete|\ElevenLabs\Types\ContextUsage|\ElevenLabs\Types\McpToolCall|\ElevenLabs\Types\ClientError|\ElevenLabs\Types\GuardrailTriggered|\ElevenLabs\Types\ConversationUserTranscript|\ElevenLabs\Types\ConversationAgentResponse|\ElevenLabs\Types\QueueStatus|\ElevenLabs\Types\AgentResponseCorrection|\ElevenLabs\Types\AgentResponseMetadata|\ElevenLabs\Types\AudioResponse|\ElevenLabs\Types\Interruption|\ElevenLabs\Types\VadScore|\ElevenLabs\Types\AgentChatResponsePart|\ElevenLabs\Types\ClientToolCall|\ElevenLabs\Types\AgentToolResponse|\ElevenLabs\Types\AgentToolResponseFullPayload|\ElevenLabs\Types\AgentToolRequest|\ElevenLabs\Types\ConversationPing|\ElevenLabs\Types\McpConnectionStatus|array<string, mixed> $value
   */
  private function __construct($value, int $typeIndex)
  {
    $this->value = $value;
    $this->typeIndex = $typeIndex;
    $this->type = match ($typeIndex) {
      0 => 'conversation_initiation_metadata',
      1 => 'agent_response_complete',
      2 => 'context_usage',
      3 => 'mcp_tool_call',
      4 => 'client_error',
      5 => 'guardrail_triggered',
      6 => 'user_transcript',
      7 => 'agent_response',
      8 => 'queue_status',
      9 => 'agent_response_correction',
      10 => 'agent_response_metadata',
      11 => 'audio',
      12 => 'interruption',
      13 => 'vad_score',
      14 => 'agent_chat_response_part',
      15 => 'client_tool_call',
      16 => 'agent_tool_response',
      17 => 'agent_tool_response_full_payload',
      18 => 'agent_tool_request',
      19 => 'ping',
      20 => 'mcp_connection_status',
      self::UNKNOWN => '_unknown',
      default => throw new \UnexpectedValueException("Unknown type index: $typeIndex")
    };
  }

  // Factory methods
  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\ConversationInitiationMetadata
   */
  public static function conversationInitiationMetadata(
    \ElevenLabs\Types\ConversationInitiationMetadata $conversationInitiationMetadata
  ): self {
    return new self($conversationInitiationMetadata, 0);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\AgentResponseComplete
   */
  public static function agentResponseComplete(
    \ElevenLabs\Types\AgentResponseComplete $agentResponseComplete
  ): self {
    return new self($agentResponseComplete, 1);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\ContextUsage
   */
  public static function contextUsage(\ElevenLabs\Types\ContextUsage $contextUsage): self
  {
    return new self($contextUsage, 2);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\McpToolCall
   */
  public static function mcpToolCall(\ElevenLabs\Types\McpToolCall $mcpToolCall): self
  {
    return new self($mcpToolCall, 3);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\ClientError
   */
  public static function clientError(\ElevenLabs\Types\ClientError $clientError): self
  {
    return new self($clientError, 4);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\GuardrailTriggered
   */
  public static function guardrailTriggered(
    \ElevenLabs\Types\GuardrailTriggered $guardrailTriggered
  ): self {
    return new self($guardrailTriggered, 5);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\ConversationUserTranscript
   */
  public static function userTranscript(
    \ElevenLabs\Types\ConversationUserTranscript $userTranscript
  ): self {
    return new self($userTranscript, 6);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\ConversationAgentResponse
   */
  public static function agentResponse(
    \ElevenLabs\Types\ConversationAgentResponse $agentResponse
  ): self {
    return new self($agentResponse, 7);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\QueueStatus
   */
  public static function queueStatus(\ElevenLabs\Types\QueueStatus $queueStatus): self
  {
    return new self($queueStatus, 8);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\AgentResponseCorrection
   */
  public static function agentResponseCorrection(
    \ElevenLabs\Types\AgentResponseCorrection $agentResponseCorrection
  ): self {
    return new self($agentResponseCorrection, 9);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\AgentResponseMetadata
   */
  public static function agentResponseMetadata(
    \ElevenLabs\Types\AgentResponseMetadata $agentResponseMetadata
  ): self {
    return new self($agentResponseMetadata, 10);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\AudioResponse
   */
  public static function audio(\ElevenLabs\Types\AudioResponse $audio): self
  {
    return new self($audio, 11);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\Interruption
   */
  public static function interruption(\ElevenLabs\Types\Interruption $interruption): self
  {
    return new self($interruption, 12);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\VadScore
   */
  public static function vadScore(\ElevenLabs\Types\VadScore $vadScore): self
  {
    return new self($vadScore, 13);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\AgentChatResponsePart
   */
  public static function agentChatResponsePart(
    \ElevenLabs\Types\AgentChatResponsePart $agentChatResponsePart
  ): self {
    return new self($agentChatResponsePart, 14);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\ClientToolCall
   */
  public static function clientToolCall(\ElevenLabs\Types\ClientToolCall $clientToolCall): self
  {
    return new self($clientToolCall, 15);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\AgentToolResponse
   */
  public static function agentToolResponse(
    \ElevenLabs\Types\AgentToolResponse $agentToolResponse
  ): self {
    return new self($agentToolResponse, 16);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\AgentToolResponseFullPayload
   */
  public static function agentToolResponseFullPayload(
    \ElevenLabs\Types\AgentToolResponseFullPayload $agentToolResponseFullPayload
  ): self {
    return new self($agentToolResponseFullPayload, 17);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\AgentToolRequest
   */
  public static function agentToolRequest(
    \ElevenLabs\Types\AgentToolRequest $agentToolRequest
  ): self {
    return new self($agentToolRequest, 18);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\ConversationPing
   */
  public static function ping(\ElevenLabs\Types\ConversationPing $ping): self
  {
    return new self($ping, 19);
  }

  /**
   * Create a SubscribeEvent instance containing a \ElevenLabs\Types\McpConnectionStatus
   */
  public static function mcpConnectionStatus(
    \ElevenLabs\Types\McpConnectionStatus $mcpConnectionStatus
  ): self {
    return new self($mcpConnectionStatus, 20);
  }

  // Type checking methods
  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\ConversationInitiationMetadata
   */
  public function isConversationInitiationMetadata(): bool
  {
    return $this->typeIndex === 0;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\AgentResponseComplete
   */
  public function isAgentResponseComplete(): bool
  {
    return $this->typeIndex === 1;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\ContextUsage
   */
  public function isContextUsage(): bool
  {
    return $this->typeIndex === 2;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\McpToolCall
   */
  public function isMcpToolCall(): bool
  {
    return $this->typeIndex === 3;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\ClientError
   */
  public function isClientError(): bool
  {
    return $this->typeIndex === 4;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\GuardrailTriggered
   */
  public function isGuardrailTriggered(): bool
  {
    return $this->typeIndex === 5;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\ConversationUserTranscript
   */
  public function isUserTranscript(): bool
  {
    return $this->typeIndex === 6;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\ConversationAgentResponse
   */
  public function isAgentResponse(): bool
  {
    return $this->typeIndex === 7;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\QueueStatus
   */
  public function isQueueStatus(): bool
  {
    return $this->typeIndex === 8;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\AgentResponseCorrection
   */
  public function isAgentResponseCorrection(): bool
  {
    return $this->typeIndex === 9;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\AgentResponseMetadata
   */
  public function isAgentResponseMetadata(): bool
  {
    return $this->typeIndex === 10;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\AudioResponse
   */
  public function isAudio(): bool
  {
    return $this->typeIndex === 11;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\Interruption
   */
  public function isInterruption(): bool
  {
    return $this->typeIndex === 12;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\VadScore
   */
  public function isVadScore(): bool
  {
    return $this->typeIndex === 13;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\AgentChatResponsePart
   */
  public function isAgentChatResponsePart(): bool
  {
    return $this->typeIndex === 14;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\ClientToolCall
   */
  public function isClientToolCall(): bool
  {
    return $this->typeIndex === 15;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\AgentToolResponse
   */
  public function isAgentToolResponse(): bool
  {
    return $this->typeIndex === 16;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\AgentToolResponseFullPayload
   */
  public function isAgentToolResponseFullPayload(): bool
  {
    return $this->typeIndex === 17;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\AgentToolRequest
   */
  public function isAgentToolRequest(): bool
  {
    return $this->typeIndex === 18;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\ConversationPing
   */
  public function isPing(): bool
  {
    return $this->typeIndex === 19;
  }

  /**
   * Check if this SubscribeEvent contains a \ElevenLabs\Types\McpConnectionStatus
   */
  public function isMcpConnectionStatus(): bool
  {
    return $this->typeIndex === 20;
  }

  // Throwing getters (fail-fast)
  /**
   * Get the \ElevenLabs\Types\ConversationInitiationMetadata value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\ConversationInitiationMetadata
   */
  public function asConversationInitiationMetadata(): \ElevenLabs\Types\ConversationInitiationMetadata
  {
    if (!$this->isConversationInitiationMetadata()) {
      throw new \RuntimeException(
        'SubscribeEvent does not contain \ElevenLabs\Types\ConversationInitiationMetadata'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AgentResponseComplete value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\AgentResponseComplete
   */
  public function asAgentResponseComplete(): \ElevenLabs\Types\AgentResponseComplete
  {
    if (!$this->isAgentResponseComplete()) {
      throw new \RuntimeException(
        'SubscribeEvent does not contain \ElevenLabs\Types\AgentResponseComplete'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ContextUsage value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\ContextUsage
   */
  public function asContextUsage(): \ElevenLabs\Types\ContextUsage
  {
    if (!$this->isContextUsage()) {
      throw new \RuntimeException('SubscribeEvent does not contain \ElevenLabs\Types\ContextUsage');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\McpToolCall value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\McpToolCall
   */
  public function asMcpToolCall(): \ElevenLabs\Types\McpToolCall
  {
    if (!$this->isMcpToolCall()) {
      throw new \RuntimeException('SubscribeEvent does not contain \ElevenLabs\Types\McpToolCall');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ClientError value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\ClientError
   */
  public function asClientError(): \ElevenLabs\Types\ClientError
  {
    if (!$this->isClientError()) {
      throw new \RuntimeException('SubscribeEvent does not contain \ElevenLabs\Types\ClientError');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\GuardrailTriggered value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\GuardrailTriggered
   */
  public function asGuardrailTriggered(): \ElevenLabs\Types\GuardrailTriggered
  {
    if (!$this->isGuardrailTriggered()) {
      throw new \RuntimeException(
        'SubscribeEvent does not contain \ElevenLabs\Types\GuardrailTriggered'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ConversationUserTranscript value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\ConversationUserTranscript
   */
  public function asUserTranscript(): \ElevenLabs\Types\ConversationUserTranscript
  {
    if (!$this->isUserTranscript()) {
      throw new \RuntimeException(
        'SubscribeEvent does not contain \ElevenLabs\Types\ConversationUserTranscript'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ConversationAgentResponse value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\ConversationAgentResponse
   */
  public function asAgentResponse(): \ElevenLabs\Types\ConversationAgentResponse
  {
    if (!$this->isAgentResponse()) {
      throw new \RuntimeException(
        'SubscribeEvent does not contain \ElevenLabs\Types\ConversationAgentResponse'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\QueueStatus value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\QueueStatus
   */
  public function asQueueStatus(): \ElevenLabs\Types\QueueStatus
  {
    if (!$this->isQueueStatus()) {
      throw new \RuntimeException('SubscribeEvent does not contain \ElevenLabs\Types\QueueStatus');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AgentResponseCorrection value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\AgentResponseCorrection
   */
  public function asAgentResponseCorrection(): \ElevenLabs\Types\AgentResponseCorrection
  {
    if (!$this->isAgentResponseCorrection()) {
      throw new \RuntimeException(
        'SubscribeEvent does not contain \ElevenLabs\Types\AgentResponseCorrection'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AgentResponseMetadata value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\AgentResponseMetadata
   */
  public function asAgentResponseMetadata(): \ElevenLabs\Types\AgentResponseMetadata
  {
    if (!$this->isAgentResponseMetadata()) {
      throw new \RuntimeException(
        'SubscribeEvent does not contain \ElevenLabs\Types\AgentResponseMetadata'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AudioResponse value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\AudioResponse
   */
  public function asAudio(): \ElevenLabs\Types\AudioResponse
  {
    if (!$this->isAudio()) {
      throw new \RuntimeException(
        'SubscribeEvent does not contain \ElevenLabs\Types\AudioResponse'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\Interruption value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\Interruption
   */
  public function asInterruption(): \ElevenLabs\Types\Interruption
  {
    if (!$this->isInterruption()) {
      throw new \RuntimeException('SubscribeEvent does not contain \ElevenLabs\Types\Interruption');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\VadScore value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\VadScore
   */
  public function asVadScore(): \ElevenLabs\Types\VadScore
  {
    if (!$this->isVadScore()) {
      throw new \RuntimeException('SubscribeEvent does not contain \ElevenLabs\Types\VadScore');
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AgentChatResponsePart value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\AgentChatResponsePart
   */
  public function asAgentChatResponsePart(): \ElevenLabs\Types\AgentChatResponsePart
  {
    if (!$this->isAgentChatResponsePart()) {
      throw new \RuntimeException(
        'SubscribeEvent does not contain \ElevenLabs\Types\AgentChatResponsePart'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ClientToolCall value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\ClientToolCall
   */
  public function asClientToolCall(): \ElevenLabs\Types\ClientToolCall
  {
    if (!$this->isClientToolCall()) {
      throw new \RuntimeException(
        'SubscribeEvent does not contain \ElevenLabs\Types\ClientToolCall'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AgentToolResponse value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\AgentToolResponse
   */
  public function asAgentToolResponse(): \ElevenLabs\Types\AgentToolResponse
  {
    if (!$this->isAgentToolResponse()) {
      throw new \RuntimeException(
        'SubscribeEvent does not contain \ElevenLabs\Types\AgentToolResponse'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AgentToolResponseFullPayload value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\AgentToolResponseFullPayload
   */
  public function asAgentToolResponseFullPayload(): \ElevenLabs\Types\AgentToolResponseFullPayload
  {
    if (!$this->isAgentToolResponseFullPayload()) {
      throw new \RuntimeException(
        'SubscribeEvent does not contain \ElevenLabs\Types\AgentToolResponseFullPayload'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\AgentToolRequest value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\AgentToolRequest
   */
  public function asAgentToolRequest(): \ElevenLabs\Types\AgentToolRequest
  {
    if (!$this->isAgentToolRequest()) {
      throw new \RuntimeException(
        'SubscribeEvent does not contain \ElevenLabs\Types\AgentToolRequest'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\ConversationPing value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\ConversationPing
   */
  public function asPing(): \ElevenLabs\Types\ConversationPing
  {
    if (!$this->isPing()) {
      throw new \RuntimeException(
        'SubscribeEvent does not contain \ElevenLabs\Types\ConversationPing'
      );
    }
    return $this->value;
  }

  /**
   * Get the \ElevenLabs\Types\McpConnectionStatus value
   * @throws \RuntimeException if this SubscribeEvent does not contain a \ElevenLabs\Types\McpConnectionStatus
   */
  public function asMcpConnectionStatus(): \ElevenLabs\Types\McpConnectionStatus
  {
    if (!$this->isMcpConnectionStatus()) {
      throw new \RuntimeException(
        'SubscribeEvent does not contain \ElevenLabs\Types\McpConnectionStatus'
      );
    }
    return $this->value;
  }

  // Safe getters (return null)
  /**
   * Try to get the \ElevenLabs\Types\ConversationInitiationMetadata value
   * @return \ElevenLabs\Types\ConversationInitiationMetadata|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\ConversationInitiationMetadata, null otherwise
   */
  public function tryAsConversationInitiationMetadata(): ?\ElevenLabs\Types\ConversationInitiationMetadata
  {
    return $this->isConversationInitiationMetadata() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AgentResponseComplete value
   * @return \ElevenLabs\Types\AgentResponseComplete|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\AgentResponseComplete, null otherwise
   */
  public function tryAsAgentResponseComplete(): ?\ElevenLabs\Types\AgentResponseComplete
  {
    return $this->isAgentResponseComplete() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ContextUsage value
   * @return \ElevenLabs\Types\ContextUsage|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\ContextUsage, null otherwise
   */
  public function tryAsContextUsage(): ?\ElevenLabs\Types\ContextUsage
  {
    return $this->isContextUsage() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\McpToolCall value
   * @return \ElevenLabs\Types\McpToolCall|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\McpToolCall, null otherwise
   */
  public function tryAsMcpToolCall(): ?\ElevenLabs\Types\McpToolCall
  {
    return $this->isMcpToolCall() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ClientError value
   * @return \ElevenLabs\Types\ClientError|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\ClientError, null otherwise
   */
  public function tryAsClientError(): ?\ElevenLabs\Types\ClientError
  {
    return $this->isClientError() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\GuardrailTriggered value
   * @return \ElevenLabs\Types\GuardrailTriggered|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\GuardrailTriggered, null otherwise
   */
  public function tryAsGuardrailTriggered(): ?\ElevenLabs\Types\GuardrailTriggered
  {
    return $this->isGuardrailTriggered() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ConversationUserTranscript value
   * @return \ElevenLabs\Types\ConversationUserTranscript|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\ConversationUserTranscript, null otherwise
   */
  public function tryAsUserTranscript(): ?\ElevenLabs\Types\ConversationUserTranscript
  {
    return $this->isUserTranscript() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ConversationAgentResponse value
   * @return \ElevenLabs\Types\ConversationAgentResponse|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\ConversationAgentResponse, null otherwise
   */
  public function tryAsAgentResponse(): ?\ElevenLabs\Types\ConversationAgentResponse
  {
    return $this->isAgentResponse() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\QueueStatus value
   * @return \ElevenLabs\Types\QueueStatus|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\QueueStatus, null otherwise
   */
  public function tryAsQueueStatus(): ?\ElevenLabs\Types\QueueStatus
  {
    return $this->isQueueStatus() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AgentResponseCorrection value
   * @return \ElevenLabs\Types\AgentResponseCorrection|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\AgentResponseCorrection, null otherwise
   */
  public function tryAsAgentResponseCorrection(): ?\ElevenLabs\Types\AgentResponseCorrection
  {
    return $this->isAgentResponseCorrection() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AgentResponseMetadata value
   * @return \ElevenLabs\Types\AgentResponseMetadata|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\AgentResponseMetadata, null otherwise
   */
  public function tryAsAgentResponseMetadata(): ?\ElevenLabs\Types\AgentResponseMetadata
  {
    return $this->isAgentResponseMetadata() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AudioResponse value
   * @return \ElevenLabs\Types\AudioResponse|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\AudioResponse, null otherwise
   */
  public function tryAsAudio(): ?\ElevenLabs\Types\AudioResponse
  {
    return $this->isAudio() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\Interruption value
   * @return \ElevenLabs\Types\Interruption|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\Interruption, null otherwise
   */
  public function tryAsInterruption(): ?\ElevenLabs\Types\Interruption
  {
    return $this->isInterruption() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\VadScore value
   * @return \ElevenLabs\Types\VadScore|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\VadScore, null otherwise
   */
  public function tryAsVadScore(): ?\ElevenLabs\Types\VadScore
  {
    return $this->isVadScore() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AgentChatResponsePart value
   * @return \ElevenLabs\Types\AgentChatResponsePart|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\AgentChatResponsePart, null otherwise
   */
  public function tryAsAgentChatResponsePart(): ?\ElevenLabs\Types\AgentChatResponsePart
  {
    return $this->isAgentChatResponsePart() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ClientToolCall value
   * @return \ElevenLabs\Types\ClientToolCall|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\ClientToolCall, null otherwise
   */
  public function tryAsClientToolCall(): ?\ElevenLabs\Types\ClientToolCall
  {
    return $this->isClientToolCall() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AgentToolResponse value
   * @return \ElevenLabs\Types\AgentToolResponse|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\AgentToolResponse, null otherwise
   */
  public function tryAsAgentToolResponse(): ?\ElevenLabs\Types\AgentToolResponse
  {
    return $this->isAgentToolResponse() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AgentToolResponseFullPayload value
   * @return \ElevenLabs\Types\AgentToolResponseFullPayload|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\AgentToolResponseFullPayload, null otherwise
   */
  public function tryAsAgentToolResponseFullPayload(): ?\ElevenLabs\Types\AgentToolResponseFullPayload
  {
    return $this->isAgentToolResponseFullPayload() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\AgentToolRequest value
   * @return \ElevenLabs\Types\AgentToolRequest|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\AgentToolRequest, null otherwise
   */
  public function tryAsAgentToolRequest(): ?\ElevenLabs\Types\AgentToolRequest
  {
    return $this->isAgentToolRequest() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\ConversationPing value
   * @return \ElevenLabs\Types\ConversationPing|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\ConversationPing, null otherwise
   */
  public function tryAsPing(): ?\ElevenLabs\Types\ConversationPing
  {
    return $this->isPing() ? $this->value : null;
  }

  /**
   * Try to get the \ElevenLabs\Types\McpConnectionStatus value
   * @return \ElevenLabs\Types\McpConnectionStatus|null Returns the value if this SubscribeEvent contains a \ElevenLabs\Types\McpConnectionStatus, null otherwise
   */
  public function tryAsMcpConnectionStatus(): ?\ElevenLabs\Types\McpConnectionStatus
  {
    return $this->isMcpConnectionStatus() ? $this->value : null;
  }

  /**
   * Pattern matching for exhaustive type handling
   * @template T
   * @param callable(\ElevenLabs\Types\ConversationInitiationMetadata): T $onConversationInitiationMetadata
   * @param callable(\ElevenLabs\Types\AgentResponseComplete): T $onAgentResponseComplete
   * @param callable(\ElevenLabs\Types\ContextUsage): T $onContextUsage
   * @param callable(\ElevenLabs\Types\McpToolCall): T $onMcpToolCall
   * @param callable(\ElevenLabs\Types\ClientError): T $onClientError
   * @param callable(\ElevenLabs\Types\GuardrailTriggered): T $onGuardrailTriggered
   * @param callable(\ElevenLabs\Types\ConversationUserTranscript): T $onUserTranscript
   * @param callable(\ElevenLabs\Types\ConversationAgentResponse): T $onAgentResponse
   * @param callable(\ElevenLabs\Types\QueueStatus): T $onQueueStatus
   * @param callable(\ElevenLabs\Types\AgentResponseCorrection): T $onAgentResponseCorrection
   * @param callable(\ElevenLabs\Types\AgentResponseMetadata): T $onAgentResponseMetadata
   * @param callable(\ElevenLabs\Types\AudioResponse): T $onAudio
   * @param callable(\ElevenLabs\Types\Interruption): T $onInterruption
   * @param callable(\ElevenLabs\Types\VadScore): T $onVadScore
   * @param callable(\ElevenLabs\Types\AgentChatResponsePart): T $onAgentChatResponsePart
   * @param callable(\ElevenLabs\Types\ClientToolCall): T $onClientToolCall
   * @param callable(\ElevenLabs\Types\AgentToolResponse): T $onAgentToolResponse
   * @param callable(\ElevenLabs\Types\AgentToolResponseFullPayload): T $onAgentToolResponseFullPayload
   * @param callable(\ElevenLabs\Types\AgentToolRequest): T $onAgentToolRequest
   * @param callable(\ElevenLabs\Types\ConversationPing): T $onPing
   * @param callable(\ElevenLabs\Types\McpConnectionStatus): T $onMcpConnectionStatus
   * @return T
   */
  public function match(
    callable $onConversationInitiationMetadata,
    callable $onAgentResponseComplete,
    callable $onContextUsage,
    callable $onMcpToolCall,
    callable $onClientError,
    callable $onGuardrailTriggered,
    callable $onUserTranscript,
    callable $onAgentResponse,
    callable $onQueueStatus,
    callable $onAgentResponseCorrection,
    callable $onAgentResponseMetadata,
    callable $onAudio,
    callable $onInterruption,
    callable $onVadScore,
    callable $onAgentChatResponsePart,
    callable $onClientToolCall,
    callable $onAgentToolResponse,
    callable $onAgentToolResponseFullPayload,
    callable $onAgentToolRequest,
    callable $onPing,
    callable $onMcpConnectionStatus
  ): mixed {
    return match ($this->typeIndex) {
      0 => $onConversationInitiationMetadata($this->value),
      1 => $onAgentResponseComplete($this->value),
      2 => $onContextUsage($this->value),
      3 => $onMcpToolCall($this->value),
      4 => $onClientError($this->value),
      5 => $onGuardrailTriggered($this->value),
      6 => $onUserTranscript($this->value),
      7 => $onAgentResponse($this->value),
      8 => $onQueueStatus($this->value),
      9 => $onAgentResponseCorrection($this->value),
      10 => $onAgentResponseMetadata($this->value),
      11 => $onAudio($this->value),
      12 => $onInterruption($this->value),
      13 => $onVadScore($this->value),
      14 => $onAgentChatResponsePart($this->value),
      15 => $onClientToolCall($this->value),
      16 => $onAgentToolResponse($this->value),
      17 => $onAgentToolResponseFullPayload($this->value),
      18 => $onAgentToolRequest($this->value),
      19 => $onPing($this->value),
      20 => $onMcpConnectionStatus($this->value),
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
        case 'conversation_initiation_metadata':
          return new self(\ElevenLabs\Types\ConversationInitiationMetadata::fromArray($data), 0);
        case 'agent_response_complete':
          return new self(\ElevenLabs\Types\AgentResponseComplete::fromArray($data), 1);
        case 'context_usage':
          return new self(\ElevenLabs\Types\ContextUsage::fromArray($data), 2);
        case 'mcp_tool_call':
          return new self(\ElevenLabs\Types\McpToolCall::fromArray($data), 3);
        case 'client_error':
          return new self(\ElevenLabs\Types\ClientError::fromArray($data), 4);
        case 'guardrail_triggered':
          return new self(\ElevenLabs\Types\GuardrailTriggered::fromArray($data), 5);
        case 'user_transcript':
          return new self(\ElevenLabs\Types\ConversationUserTranscript::fromArray($data), 6);
        case 'agent_response':
          return new self(\ElevenLabs\Types\ConversationAgentResponse::fromArray($data), 7);
        case 'queue_status':
          return new self(\ElevenLabs\Types\QueueStatus::fromArray($data), 8);
        case 'agent_response_correction':
          return new self(\ElevenLabs\Types\AgentResponseCorrection::fromArray($data), 9);
        case 'agent_response_metadata':
          return new self(\ElevenLabs\Types\AgentResponseMetadata::fromArray($data), 10);
        case 'audio':
          return new self(\ElevenLabs\Types\AudioResponse::fromArray($data), 11);
        case 'interruption':
          return new self(\ElevenLabs\Types\Interruption::fromArray($data), 12);
        case 'vad_score':
          return new self(\ElevenLabs\Types\VadScore::fromArray($data), 13);
        case 'agent_chat_response_part':
          return new self(\ElevenLabs\Types\AgentChatResponsePart::fromArray($data), 14);
        case 'client_tool_call':
          return new self(\ElevenLabs\Types\ClientToolCall::fromArray($data), 15);
        case 'agent_tool_response':
          return new self(\ElevenLabs\Types\AgentToolResponse::fromArray($data), 16);
        case 'agent_tool_response_full_payload':
          return new self(\ElevenLabs\Types\AgentToolResponseFullPayload::fromArray($data), 17);
        case 'agent_tool_request':
          return new self(\ElevenLabs\Types\AgentToolRequest::fromArray($data), 18);
        case 'ping':
          return new self(\ElevenLabs\Types\ConversationPing::fromArray($data), 19);
        case 'mcp_connection_status':
          return new self(\ElevenLabs\Types\McpConnectionStatus::fromArray($data), 20);
        default:
          // A variant the API added after this SDK was generated: kept, not rejected.
          return new self($data, self::UNKNOWN);
      }
    }

    /** @var list<array{instance: mixed, idx: int, score: int}> */
    $candidates = [];
    try {
      $candidate = \ElevenLabs\Types\ConversationInitiationMetadata::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 0, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationInitiationMetadata didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AgentResponseComplete::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 1, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AgentResponseComplete didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ContextUsage::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 2, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ContextUsage didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\McpToolCall::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 3, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\McpToolCall didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ClientError::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 4, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ClientError didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\GuardrailTriggered::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 5, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\GuardrailTriggered didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ConversationUserTranscript::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 6, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationUserTranscript didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ConversationAgentResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 7, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationAgentResponse didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\QueueStatus::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 8, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\QueueStatus didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AgentResponseCorrection::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 9, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AgentResponseCorrection didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AgentResponseMetadata::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 10, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AgentResponseMetadata didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AudioResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 11, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AudioResponse didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\Interruption::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 12, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\Interruption didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\VadScore::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 13, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\VadScore didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AgentChatResponsePart::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 14, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AgentChatResponsePart didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ClientToolCall::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 15, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ClientToolCall didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AgentToolResponse::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 16, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AgentToolResponse didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AgentToolResponseFullPayload::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 17, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AgentToolResponseFullPayload didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\AgentToolRequest::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 18, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\AgentToolRequest didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\ConversationPing::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 19, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\ConversationPing didn't match, continue to next type
    }

    try {
      $candidate = \ElevenLabs\Types\McpConnectionStatus::fromArray($data);
      // Keys the variant actually mapped = input keys minus the ones it could not place.
      $score = count($data) - count($candidate->getAdditionalProperties());
      $candidates[] = ['instance' => $candidate, 'idx' => 20, 'score' => $score];
    } catch (\Throwable $e) {
      // Throwable, because under fernMode "this variant does not match" arrives as whatever
      // the shared deserializer raises — a JsonException for a missing required field, not
      // just a TypeError. Narrowing it turns a non-matching variant into a fatal.
      // \ElevenLabs\Types\McpConnectionStatus didn't match, continue to next type
    }

    if (count($candidates) === 0) {
      throw new \InvalidArgumentException('Data does not match any SubscribeEvent type');
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

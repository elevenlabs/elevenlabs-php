<?php

declare(strict_types=1);

namespace ElevenLabs\Agents;

use ElevenLabs\Core\WebSocket\WebSocketSocket;

/**
 * @extends WebSocketSocket<\ElevenLabs\Types\ConversationInitiationMetadata|\ElevenLabs\Types\AgentResponseComplete|\ElevenLabs\Types\ContextUsage|\ElevenLabs\Types\McpToolCall|\ElevenLabs\Types\ClientError|\ElevenLabs\Types\GuardrailTriggered|\ElevenLabs\Types\ConversationUserTranscript|\ElevenLabs\Types\ConversationAgentResponse|\ElevenLabs\Types\QueueStatus|\ElevenLabs\Types\AgentResponseCorrection|\ElevenLabs\Types\AgentResponseMetadata|\ElevenLabs\Types\AudioResponse|\ElevenLabs\Types\Interruption|\ElevenLabs\Types\VadScore|\ElevenLabs\Types\AgentChatResponsePart|\ElevenLabs\Types\ClientToolCall|\ElevenLabs\Types\AgentToolResponse|\ElevenLabs\Types\AgentToolResponseFullPayload|\ElevenLabs\Types\AgentToolRequest|\ElevenLabs\Types\ConversationPing|\ElevenLabs\Types\McpConnectionStatus|array<mixed>|string>
 */
final class V1ConvaiConversationSocket extends WebSocketSocket
{
  public function sendPublish(\ElevenLabs\Types\PublishEvent $message): void
  {
    $this->send($message);
  }

  /**
   * @return \ElevenLabs\Types\ConversationInitiationMetadata|\ElevenLabs\Types\AgentResponseComplete|\ElevenLabs\Types\ContextUsage|\ElevenLabs\Types\McpToolCall|\ElevenLabs\Types\ClientError|\ElevenLabs\Types\GuardrailTriggered|\ElevenLabs\Types\ConversationUserTranscript|\ElevenLabs\Types\ConversationAgentResponse|\ElevenLabs\Types\QueueStatus|\ElevenLabs\Types\AgentResponseCorrection|\ElevenLabs\Types\AgentResponseMetadata|\ElevenLabs\Types\AudioResponse|\ElevenLabs\Types\Interruption|\ElevenLabs\Types\VadScore|\ElevenLabs\Types\AgentChatResponsePart|\ElevenLabs\Types\ClientToolCall|\ElevenLabs\Types\AgentToolResponse|\ElevenLabs\Types\AgentToolResponseFullPayload|\ElevenLabs\Types\AgentToolRequest|\ElevenLabs\Types\ConversationPing|\ElevenLabs\Types\McpConnectionStatus|array<mixed>|string
   */
  protected function parse(string $text): mixed
  {
    $data = json_decode($text, true, 512, JSON_THROW_ON_ERROR);
    if (!is_array($data)) {
      return $text;
    }
    if (($data['type'] ?? null) === 'conversation_initiation_metadata') {
      return self::tryDeserialize(\ElevenLabs\Types\ConversationInitiationMetadata::class, $data) ??
        $data;
    }
    if (($data['type'] ?? null) === 'agent_response_complete') {
      return self::tryDeserialize(\ElevenLabs\Types\AgentResponseComplete::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'context_usage') {
      return self::tryDeserialize(\ElevenLabs\Types\ContextUsage::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'mcp_tool_call') {
      return self::tryDeserialize(\ElevenLabs\Types\McpToolCall::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'client_error') {
      return self::tryDeserialize(\ElevenLabs\Types\ClientError::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'guardrail_triggered') {
      return self::tryDeserialize(\ElevenLabs\Types\GuardrailTriggered::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'user_transcript') {
      return self::tryDeserialize(\ElevenLabs\Types\ConversationUserTranscript::class, $data) ??
        $data;
    }
    if (($data['type'] ?? null) === 'agent_response') {
      return self::tryDeserialize(\ElevenLabs\Types\ConversationAgentResponse::class, $data) ??
        $data;
    }
    if (($data['type'] ?? null) === 'queue_status') {
      return self::tryDeserialize(\ElevenLabs\Types\QueueStatus::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'agent_response_correction') {
      return self::tryDeserialize(\ElevenLabs\Types\AgentResponseCorrection::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'agent_response_metadata') {
      return self::tryDeserialize(\ElevenLabs\Types\AgentResponseMetadata::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'audio') {
      return self::tryDeserialize(\ElevenLabs\Types\AudioResponse::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'interruption') {
      return self::tryDeserialize(\ElevenLabs\Types\Interruption::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'vad_score') {
      return self::tryDeserialize(\ElevenLabs\Types\VadScore::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'agent_chat_response_part') {
      return self::tryDeserialize(\ElevenLabs\Types\AgentChatResponsePart::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'client_tool_call') {
      return self::tryDeserialize(\ElevenLabs\Types\ClientToolCall::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'agent_tool_response') {
      return self::tryDeserialize(\ElevenLabs\Types\AgentToolResponse::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'agent_tool_response_full_payload') {
      return self::tryDeserialize(\ElevenLabs\Types\AgentToolResponseFullPayload::class, $data) ??
        $data;
    }
    if (($data['type'] ?? null) === 'agent_tool_request') {
      return self::tryDeserialize(\ElevenLabs\Types\AgentToolRequest::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'ping') {
      return self::tryDeserialize(\ElevenLabs\Types\ConversationPing::class, $data) ?? $data;
    }
    if (($data['type'] ?? null) === 'mcp_connection_status') {
      return self::tryDeserialize(\ElevenLabs\Types\McpConnectionStatus::class, $data) ?? $data;
    }
    return $data;
  }
}

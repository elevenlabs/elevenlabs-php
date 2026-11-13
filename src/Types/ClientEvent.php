<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ClientEvent: string
{
  case ConversationInitiationMetadata = 'conversation_initiation_metadata';
  case AsrInitiationMetadata = 'asr_initiation_metadata';
  case Ping = 'ping';
  case Audio = 'audio';
  case Interruption = 'interruption';
  case UserTranscript = 'user_transcript';
  case TentativeUserTranscript = 'tentative_user_transcript';
  case AgentResponse = 'agent_response';
  case AgentResponseCorrection = 'agent_response_correction';
  case ClientToolCall = 'client_tool_call';
  case McpToolCall = 'mcp_tool_call';
  case McpConnectionStatus = 'mcp_connection_status';
  case AgentToolRequest = 'agent_tool_request';
  case AgentToolResponse = 'agent_tool_response';
  case AgentToolResponseFullPayload = 'agent_tool_response_full_payload';
  case AgentResponseMetadata = 'agent_response_metadata';
  case VadScore = 'vad_score';
  case AgentChatResponsePart = 'agent_chat_response_part';
  case ClientError = 'client_error';
  case GuardrailTriggered = 'guardrail_triggered';
  case DtmfRequest = 'dtmf_request';
  case AgentResponseComplete = 'agent_response_complete';
  case ContextUsage = 'context_usage';
  case InternalTurnProbability = 'internal_turn_probability';
  case InternalTentativeAgentResponse = 'internal_tentative_agent_response';
}

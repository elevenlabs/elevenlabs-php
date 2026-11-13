<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * User-facing error types exposed on the public API.
 */
enum ResponseConversationErrorType: string
{
  case SystemError = 'system_error';
  case CallInitializationError = 'call_initialization_error';
  case LineBusy = 'line_busy';
  case NoAnswer = 'no_answer';
  case CallRejected = 'call_rejected';
  case BlockedByUser = 'blocked_by_user';
  case AgentConfigurationError = 'agent_configuration_error';
  case InvalidClientRequest = 'invalid_client_request';
  case PermissionError = 'permission_error';
  case EntitlementExceeded = 'entitlement_exceeded';
  case ClientDisconnected = 'client_disconnected';
  case LlmError = 'llm_error';
  case SpeechError = 'speech_error';
  case ToolError = 'tool_error';
  case IntegrationError = 'integration_error';
  case GuardrailTriggered = 'guardrail_triggered';
  case SafetyViolation = 'safety_violation';
  case MaxDurationExceeded = 'max_duration_exceeded';
  case PostProcessingError = 'post_processing_error';
}

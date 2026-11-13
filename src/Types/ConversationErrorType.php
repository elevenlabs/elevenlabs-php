<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Stored in conversation history. Never exposed to customers directly.
 */
enum ConversationErrorType: string
{
  case Unknown = 'unknown';
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
  case DependencyError = 'dependency_error';
  case GuardrailTriggered = 'guardrail_triggered';
  case SafetyViolation = 'safety_violation';
  case MaxDurationExceeded = 'max_duration_exceeded';
  case WorkflowEndFailure = 'workflow_end_failure';
  case InternalError = 'internal_error';
  case PostProcessingError = 'post_processing_error';
}

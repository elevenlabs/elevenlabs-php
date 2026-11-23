<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Reasoning effort of the model. Only available for some models.
 */
enum ConversationInitiationClientDataConversationConfigOverrideAgentPromptReasoningEffort: string
{
  case None = 'none';
  case Minimal = 'minimal';
  case Low = 'low';
  case Medium = 'medium';
  case High = 'high';
  case Xhigh = 'xhigh';
  case Max = 'max';
}

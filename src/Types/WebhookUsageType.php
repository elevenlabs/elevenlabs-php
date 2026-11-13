<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum WebhookUsageType: string
{
  case ConvAiAgentSettings = 'ConvAI Agent Settings';
  case ConvAiSettings = 'ConvAI Settings';
  case VoiceLibraryRemovalNotices = 'Voice Library Removal Notices';
  case SpeechToText = 'Speech to Text';
  case AgentQaEvaluations = 'Agent QA Evaluations';
  case ConvAiAlerting = 'ConvAI Alerting';
  case Flows = 'Flows';
  case Dubbing = 'Dubbing';
}

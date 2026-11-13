<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum WorkspaceWebhookEventType: string
{
  case VoiceLibraryRemovalNotice = 'voice_library_removal_notice';
  case SpeechToText = 'speech_to_text';
  case AgentQa = 'agent_qa';
  case Flows = 'flows';
}

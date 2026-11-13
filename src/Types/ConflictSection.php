<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ConflictSection: string
{
  case ConversationConfig = 'conversation_config';
  case PlatformSettings = 'platform_settings';
  case Procedures = 'procedures';
  case Workflow = 'workflow';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ConversationHistoryTranscriptCommonModelOutputRole: string
{
  case User = 'user';
  case Agent = 'agent';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ConversationHistoryTranscriptResponseModelRole: string
{
  case User = 'user';
  case Agent = 'agent';
}

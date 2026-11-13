<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ConversationHistoryTranscriptOtherToolsResultCommonModelType: string
{
  case Client = 'client';
  case Webhook = 'webhook';
  case Mcp = 'mcp';
  case Code = 'code';
}

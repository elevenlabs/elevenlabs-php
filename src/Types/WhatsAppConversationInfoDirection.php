<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum WhatsAppConversationInfoDirection: string
{
  case Inbound = 'inbound';
  case Outbound = 'outbound';
  case Unknown = 'unknown';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SmsConversationInfoDirection: string
{
  case Inbound = 'inbound';
  case Outbound = 'outbound';
}

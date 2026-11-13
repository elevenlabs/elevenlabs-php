<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum WhatsAppCallPermissionRequestState: string
{
  case Blocked = 'blocked';
  case Sent = 'sent';
  case Accepted = 'accepted';
  case Declined = 'declined';
}

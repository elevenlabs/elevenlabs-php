<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ReceptionNotificationChannel: string
{
  case Email = 'email';
  case Sms = 'sms';
}

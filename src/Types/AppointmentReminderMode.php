<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AppointmentReminderMode: string
{
  case Reminder = 'reminder';
  case Confirmation = 'confirmation';
}

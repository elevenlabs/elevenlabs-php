<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CreateTwilioPhoneNumberRequestProvider: string
{
  case Twilio = 'twilio';
}

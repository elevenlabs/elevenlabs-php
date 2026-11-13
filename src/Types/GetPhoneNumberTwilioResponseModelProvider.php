<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Phone provider
 */
enum GetPhoneNumberTwilioResponseModelProvider: string
{
  case Twilio = 'twilio';
}

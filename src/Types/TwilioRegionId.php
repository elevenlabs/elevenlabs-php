<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Valid Twilio region IDs.
 */
enum TwilioRegionId: string
{
  case Us1 = 'us1';
  case Ie1 = 'ie1';
  case Au1 = 'au1';
}

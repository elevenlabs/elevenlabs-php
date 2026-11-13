<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TelephonyProvider: string
{
  case Twilio = 'twilio';
  case SipTrunk = 'sip_trunk';
  case Exotel = 'exotel';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * How calls to the number reach ElevenLabs: through Twilio or a SIP trunk.
 */
enum ReceptionPhoneProvider: string
{
  case Twilio = 'twilio';
  case SipTrunk = 'sip_trunk';
}

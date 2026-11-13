<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Phone provider
 */
enum GetPhoneNumberSipTrunkResponseModelProvider: string
{
  case SipTrunk = 'sip_trunk';
}

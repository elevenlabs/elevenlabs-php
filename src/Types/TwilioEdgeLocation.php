<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Valid Twilio edge locations.
 */
enum TwilioEdgeLocation: string
{
  case Ashburn = 'ashburn';
  case Dublin = 'dublin';
  case Frankfurt = 'frankfurt';
  case SaoPaulo = 'sao-paulo';
  case Singapore = 'singapore';
  case Sydney = 'sydney';
  case Tokyo = 'tokyo';
  case Umatilla = 'umatilla';
  case Roaming = 'roaming';
}

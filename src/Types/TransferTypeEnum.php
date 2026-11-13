<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TransferTypeEnum: string
{
  case Blind = 'blind';
  case Conference = 'conference';
  case SipRefer = 'sip_refer';
}

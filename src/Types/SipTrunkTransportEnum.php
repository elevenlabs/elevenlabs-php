<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SipTrunkTransportEnum: string
{
  case Auto = 'auto';
  case Udp = 'udp';
  case Tcp = 'tcp';
  case Tls = 'tls';
}

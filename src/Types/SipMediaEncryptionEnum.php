<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SipMediaEncryptionEnum: string
{
  case Disabled = 'disabled';
  case Allowed = 'allowed';
  case Required = 'required';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum VoiceSafetyControl: string
{
  case None = 'NONE';
  case Ban = 'BAN';
  case Captcha = 'CAPTCHA';
  case EnterpriseBan = 'ENTERPRISE_BAN';
  case EnterpriseCaptcha = 'ENTERPRISE_CAPTCHA';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Preset tone for an SMS message body.
 */
enum SmsTemplateStyle: string
{
  case Friendly = 'friendly';
  case Professional = 'professional';
  case Concise = 'concise';
}

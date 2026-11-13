<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Identifies this warning; branch on it to read the other fields.
 */
enum VoicesNotPermittedWarningType: string
{
  case VoicesNotPermitted = 'voices_not_permitted';
}

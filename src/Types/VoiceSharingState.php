<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The status of the voice sharing.
 */
enum VoiceSharingState: string
{
  case Enabled = 'enabled';
  case Disabled = 'disabled';
  case Copied = 'copied';
  case CopiedDisabled = 'copied_disabled';
}

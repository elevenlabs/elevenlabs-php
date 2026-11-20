<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TeamInviteOutcome: string
{
  case Invited = 'invited';
  case Failed = 'failed';
}

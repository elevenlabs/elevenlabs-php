<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The type of the principal: user, group, or service account (under 'key').
 */
enum ShareOptionResponseModelType: string
{
  case User = 'user';
  case Group = 'group';
  case Key = 'key';
}

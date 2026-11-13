<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TestSharingMode: string
{
  case All = 'all';
  case SharedWithMe = 'shared_with_me';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ProjectResponseFiction: string
{
  case Fiction = 'fiction';
  case NonFiction = 'non-fiction';
}

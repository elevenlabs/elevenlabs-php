<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum MockingStrategy: string
{
  case All = 'all';
  case Selected = 'selected';
  case None = 'none';
}

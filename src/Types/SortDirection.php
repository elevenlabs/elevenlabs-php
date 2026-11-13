<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SortDirection: string
{
  case Asc = 'asc';
  case Desc = 'desc';
}

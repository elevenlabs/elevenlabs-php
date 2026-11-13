<?php

declare(strict_types=1);

namespace ElevenLabs\History\Types;

enum ListHistoryRequestSortDirection: string
{
  case Asc = 'asc';
  case Desc = 'desc';
}

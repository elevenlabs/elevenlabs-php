<?php

declare(strict_types=1);

namespace ElevenLabs\Music\Finetunes\Types;

/**
 * Sort direction (asc or desc)
 */
enum ListFinetunesRequestSortDirection: string
{
  case Asc = 'asc';
  case Desc = 'desc';
}

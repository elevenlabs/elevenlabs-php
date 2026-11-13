<?php

declare(strict_types=1);

namespace ElevenLabs\Music\Finetunes\Types;

/**
 * Sort by field (created_at or name)
 */
enum ListFinetunesRequestSort: string
{
  case CreatedAt = 'created_at';
  case Name = 'name';
}

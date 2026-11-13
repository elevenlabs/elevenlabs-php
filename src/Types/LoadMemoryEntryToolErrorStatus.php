<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum LoadMemoryEntryToolErrorStatus: string
{
  case NotFound = 'not_found';
  case InvalidId = 'invalid_id';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum EndProcedureToolErrorStatus: string
{
  case NotFound = 'not_found';
  case InvalidId = 'invalid_id';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum StartProcedureToolErrorStatus: string
{
  case NotFound = 'not_found';
  case InvalidName = 'invalid_name';
  case AlreadyActive = 'already_active';
}

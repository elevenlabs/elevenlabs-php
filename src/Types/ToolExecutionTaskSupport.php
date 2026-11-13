<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ToolExecutionTaskSupport: string
{
  case Forbidden = 'forbidden';
  case Optional = 'optional';
  case Required = 'required';
}

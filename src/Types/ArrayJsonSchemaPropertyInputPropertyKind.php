<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ArrayJsonSchemaPropertyInputPropertyKind: string
{
  case Array = 'array';
  case Object = 'object';
}

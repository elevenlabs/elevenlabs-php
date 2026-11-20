<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum QueryArrayJsonSchemaPropertyInputPropertyKind: string
{
  case Array = 'array';
  case Object = 'object';
}

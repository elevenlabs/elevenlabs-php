<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AnalysisPropertyType: string
{
  case Boolean = 'boolean';
  case String = 'string';
  case Integer = 'integer';
  case Number = 'number';
}

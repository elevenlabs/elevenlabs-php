<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AnalysisItemSource: string
{
  case User = 'user';
  case System = 'system';
}

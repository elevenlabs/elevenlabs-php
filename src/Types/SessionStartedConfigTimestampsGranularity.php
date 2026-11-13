<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SessionStartedConfigTimestampsGranularity: string
{
  case None = 'none';
  case Word = 'word';
  case Character = 'character';
}

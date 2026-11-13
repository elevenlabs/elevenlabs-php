<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum VideoAnalysisStatus: string
{
  case Processing = 'processing';
  case Completed = 'completed';
  case Failed = 'failed';
}

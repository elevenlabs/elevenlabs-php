<?php

declare(strict_types=1);

namespace ElevenLabs\Flows\Video\Types;

enum ListVideoRequestStatus: string
{
  case Pending = 'pending';
  case Generating = 'generating';
  case Completed = 'completed';
  case Failed = 'failed';
}

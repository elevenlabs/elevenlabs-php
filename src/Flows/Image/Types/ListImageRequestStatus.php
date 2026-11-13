<?php

declare(strict_types=1);

namespace ElevenLabs\Flows\Image\Types;

enum ListImageRequestStatus: string
{
  case Pending = 'pending';
  case Generating = 'generating';
  case Completed = 'completed';
  case Failed = 'failed';
}

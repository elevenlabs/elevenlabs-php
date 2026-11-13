<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum BucketingStatus: string
{
  case Pending = 'pending';
  case Completed = 'completed';
  case Failed = 'failed';
}

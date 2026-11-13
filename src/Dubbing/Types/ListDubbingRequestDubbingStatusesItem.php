<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Types;

enum ListDubbingRequestDubbingStatusesItem: string
{
  case Queued = 'queued';
  case Preparing = 'preparing';
  case Dubbing = 'dubbing';
  case Dubbed = 'dubbed';
  case Failed = 'failed';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ExternalSyncJobType: string
{
  case Full = 'full';
  case Incremental = 'incremental';
}

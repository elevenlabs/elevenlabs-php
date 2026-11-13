<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ExternalSyncJobTrigger: string
{
  case OnDemand = 'on_demand';
  case OnConnect = 'on_connect';
  case Auto = 'auto';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\OutboundCampaigns\Leads\Types;

enum ListLeadsRequestStatus: string
{
  case InProgress = 'in_progress';
  case Finished = 'finished';
}

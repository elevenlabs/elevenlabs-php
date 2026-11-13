<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\OutboundCampaigns\Types;

enum ListOutboundCampaignsRequestMode: string
{
  case Voice = 'voice';
  case Message = 'message';
}

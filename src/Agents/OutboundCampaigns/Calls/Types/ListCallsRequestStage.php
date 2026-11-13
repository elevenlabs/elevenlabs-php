<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\OutboundCampaigns\Calls\Types;

enum ListCallsRequestStage: string
{
  case Queued = 'queued';
  case Sent = 'sent';
  case Delivered = 'delivered';
  case Read = 'read';
  case Replied = 'replied';
  case Failed = 'failed';
}

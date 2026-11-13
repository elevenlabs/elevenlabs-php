<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CampaignStatus: string
{
  case Active = 'active';
  case Paused = 'paused';
  case Stopping = 'stopping';
  case Stopped = 'stopped';
  case Completed = 'completed';
  case Failed = 'failed';
  case Attention = 'attention';
}

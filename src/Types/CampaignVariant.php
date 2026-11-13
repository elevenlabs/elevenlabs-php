<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CampaignVariant: string
{
  case Simple = 'simple';
  case Advanced = 'advanced';
}

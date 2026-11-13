<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CampaignSource: string
{
  case Ui = 'ui';
  case Api = 'api';
}

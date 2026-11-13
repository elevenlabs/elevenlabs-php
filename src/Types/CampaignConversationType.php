<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CampaignConversationType: string
{
  case Initial = 'initial';
  case Retry = 'retry';
  case Callback = 'callback';
  case Redirect = 'redirect';
}

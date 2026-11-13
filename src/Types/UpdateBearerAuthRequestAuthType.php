<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum UpdateBearerAuthRequestAuthType: string
{
  case BearerAuth = 'bearer_auth';
}

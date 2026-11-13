<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CreateBearerAuthRequestAuthType: string
{
  case BearerAuth = 'bearer_auth';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CreateCustomHeaderAuthRequestAuthType: string
{
  case CustomHeaderAuth = 'custom_header_auth';
}

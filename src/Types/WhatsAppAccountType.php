<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum WhatsAppAccountType: string
{
  case CloudApi = 'cloud_api';
  case Coexistence = 'coexistence';
}

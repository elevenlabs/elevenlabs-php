<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AlertingWebhookMethod: string
{
  case Post = 'POST';
  case Put = 'PUT';
}

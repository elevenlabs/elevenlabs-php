<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum WebhookHttpMethod: string
{
  case Get = 'GET';
  case Post = 'POST';
  case Put = 'PUT';
  case Patch = 'PATCH';
  case Delete = 'DELETE';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum WebhookTranscriptFormat: string
{
  case Json = 'json';
  case Opentelemetry = 'opentelemetry';
}

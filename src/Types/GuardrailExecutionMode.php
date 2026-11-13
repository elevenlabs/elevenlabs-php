<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum GuardrailExecutionMode: string
{
  case Streaming = 'streaming';
  case Blocking = 'blocking';
}

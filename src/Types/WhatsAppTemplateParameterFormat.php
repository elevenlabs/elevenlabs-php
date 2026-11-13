<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum WhatsAppTemplateParameterFormat: string
{
  case Positional = 'POSITIONAL';
  case Named = 'NAMED';
}

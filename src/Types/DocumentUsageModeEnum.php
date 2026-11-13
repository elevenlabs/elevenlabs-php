<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum DocumentUsageModeEnum: string
{
  case Prompt = 'prompt';
  case Auto = 'auto';
}

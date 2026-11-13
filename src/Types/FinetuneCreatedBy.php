<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum FinetuneCreatedBy: string
{
  case Self = 'self';
  case Workspace = 'workspace';
  case Elevenlabs = 'elevenlabs';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ConflictResolutionChoice: string
{
  case Source = 'source';
  case Target = 'target';
  case Custom = 'custom';
}

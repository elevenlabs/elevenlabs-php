<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AgentTestEntityType: string
{
  case Test = 'test';
  case Folder = 'folder';
}

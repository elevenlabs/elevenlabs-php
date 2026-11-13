<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum EntryBehavior: string
{
  case GenerateImmediately = 'generate_immediately';
  case WaitForUser = 'wait_for_user';
  case Auto = 'auto';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum RenderStatus: string
{
  case Complete = 'complete';
  case Processing = 'processing';
  case Failed = 'failed';
}

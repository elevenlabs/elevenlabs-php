<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AssetTranscriptionStatus: string
{
  case Processing = 'processing';
  case Completed = 'completed';
  case Failed = 'failed';
}

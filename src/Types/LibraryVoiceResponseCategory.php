<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The category of the voice.
 */
enum LibraryVoiceResponseCategory: string
{
  case Generated = 'generated';
  case Cloned = 'cloned';
  case Premade = 'premade';
  case Professional = 'professional';
  case Famous = 'famous';
  case HighQuality = 'high_quality';
}

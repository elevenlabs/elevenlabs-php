<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TtsModelFamily: string
{
  case Turbo = 'turbo';
  case Flash = 'flash';
  case Multilingual = 'multilingual';
  case V3Conversational = 'v3_conversational';
  case V4 = 'v4';
  case V4Turbo = 'v4_turbo';
}

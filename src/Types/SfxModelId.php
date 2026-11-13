<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SfxModelId: string
{
  case ElevenTextToSoundV2 = 'eleven_text_to_sound_v2';
  case ElevenTextToSoundV3 = 'eleven_text_to_sound_v3';
}

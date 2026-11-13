<?php

declare(strict_types=1);

namespace ElevenLabs\AudioNative\Types;

enum CreateAudioNativeRequestApplyTextNormalization: string
{
  case Auto = 'auto';
  case On = 'on';
  case Off = 'off';
  case ApplyEnglish = 'apply_english';
}

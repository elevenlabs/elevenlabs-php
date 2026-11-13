<?php

declare(strict_types=1);

namespace ElevenLabs\TextToSpeech\Types;

/**
 * This parameter controls text normalization with three modes: 'auto', 'on', and 'off'. When set to 'auto', the system will automatically decide whether to apply text normalization (e.g., spelling out numbers). With 'on', text normalization will always be applied, while with 'off', it will be skipped.
 */
enum BodyTextToSpeechStreamWithTimestampsApplyTextNormalization: string
{
  case Auto = 'auto';
  case On = 'on';
  case Off = 'off';
}

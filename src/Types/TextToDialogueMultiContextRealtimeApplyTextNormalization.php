<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * A string parameter to control text normalization.
 */
enum TextToDialogueMultiContextRealtimeApplyTextNormalization: string
{
  case Auto = 'auto';
  case On = 'on';
  case Off = 'off';
  case ApplyEnglish = 'apply_english';
}

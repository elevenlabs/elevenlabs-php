<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Whether text normalization is applied to the project.
 */
enum ProjectExtendedResponseApplyTextNormalization: string
{
  case Auto = 'auto';
  case On = 'on';
  case Off = 'off';
  case ApplyEnglish = 'apply_english';
}

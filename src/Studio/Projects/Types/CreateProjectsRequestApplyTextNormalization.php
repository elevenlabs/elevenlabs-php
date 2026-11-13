<?php

declare(strict_types=1);

namespace ElevenLabs\Studio\Projects\Types;

enum CreateProjectsRequestApplyTextNormalization: string
{
  case Auto = 'auto';
  case On = 'on';
  case Off = 'off';
  case ApplyEnglish = 'apply_english';
}

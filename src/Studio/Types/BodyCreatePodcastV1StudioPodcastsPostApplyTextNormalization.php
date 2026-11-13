<?php

declare(strict_types=1);

namespace ElevenLabs\Studio\Types;

enum BodyCreatePodcastV1StudioPodcastsPostApplyTextNormalization: string
{
  case Auto = 'auto';
  case On = 'on';
  case Off = 'off';
  case ApplyEnglish = 'apply_english';
}

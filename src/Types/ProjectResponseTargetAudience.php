<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ProjectResponseTargetAudience: string
{
  case Children = 'children';
  case YoungAdult = 'young adult';
  case Adult = 'adult';
  case AllAges = 'all ages';
}

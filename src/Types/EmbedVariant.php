<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum EmbedVariant: string
{
  case Tiny = 'tiny';
  case Compact = 'compact';
  case Full = 'full';
  case Expandable = 'expandable';
}

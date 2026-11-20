<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Widget size, from the smallest ('tiny') to the largest ('full').
 */
enum ReceptionWidgetAppearanceVariant: string
{
  case Tiny = 'tiny';
  case Compact = 'compact';
  case Full = 'full';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Types;

/**
 * Voice category used for filtering
 */
enum FindSimilarVoicesVoicesRequestCategory: string
{
  case Professional = 'professional';
  case Famous = 'famous';
  case HighQuality = 'high_quality';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Music\Types;

/**
 * The id of the stem variation to use.
 */
enum SeparateStemsMusicRequestStemVariationId: string
{
  case TwoStemsV1 = 'two_stems_v1';
  case SixStemsV1 = 'six_stems_v1';
}

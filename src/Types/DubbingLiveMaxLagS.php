<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Seconds the dubbed audio may lag the source audio at most: every stretch of the output is sent within this long of its source audio arriving, the source audio itself where a dub can't be ready in time. Longer lags dub more of the speech and translate whole sentences more often.
 */
enum DubbingLiveMaxLagS: int
{
  case Ten = 10;
  case Twelve = 12;
  case Fifteen = 15;
  case Eighteen = 18;
  case Twenty = 20;
  case TwentyFive = 25;
  case Thirty = 30;
}

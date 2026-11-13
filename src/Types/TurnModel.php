<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Version of the turn detection model to use.
 */
enum TurnModel: string
{
  case TurnV2 = 'turn_v2';
  case TurnV3 = 'turn_v3';
}

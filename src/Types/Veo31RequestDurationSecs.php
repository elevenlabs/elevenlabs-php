<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The duration of the output video in seconds.
 */
enum Veo31RequestDurationSecs: int
{
  case Four = 4;
  case Six = 6;
  case Eight = 8;
}

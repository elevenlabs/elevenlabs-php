<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TtsOptimizeStreamingLatency: int
{
  case Zero = 0;
  case One = 1;
  case Two = 2;
  case Three = 3;
  case Four = 4;
}

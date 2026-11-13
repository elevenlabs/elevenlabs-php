<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Types;

enum ListDubbingRequestDubbingModelsItem: string
{
  case DubbingV1 = 'dubbing_v1';
  case DubbingV2 = 'dubbing_v2';
}

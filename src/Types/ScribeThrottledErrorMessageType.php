<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ScribeThrottledErrorMessageType: string
{
  case CommitThrottled = 'commit_throttled';
}

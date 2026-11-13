<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum PendingCancellationResponseModelKind: string
{
  case Cancellation = 'cancellation';
}

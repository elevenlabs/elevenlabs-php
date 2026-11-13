<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * OCSF Status levels.
 *
 * Spec: https://schema.ocsf.io/1.6.0/objects/status_id
 */
enum StatusId: int
{
  case Zero = 0;
  case One = 1;
  case Two = 2;
  case NinetyNine = 99;
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * OCSF Severity levels.
 *
 * Spec: https://schema.ocsf.io/1.6.0/objects/severity_id
 */
enum SeverityId: int
{
  case Zero = 0;
  case One = 1;
  case Two = 2;
  case Three = 3;
  case Four = 4;
  case Five = 5;
  case Six = 6;
  case NinetyNine = 99;
}

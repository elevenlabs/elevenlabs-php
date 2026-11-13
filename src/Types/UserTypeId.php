<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * OCSF User type IDs.
 *
 * Spec: https://schema.ocsf.io/1.6.0/objects/user
 */
enum UserTypeId: int
{
  case Zero = 0;
  case One = 1;
  case Two = 2;
  case Three = 3;
  case Four = 4;
  case NinetyNine = 99;
}

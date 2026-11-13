<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * OCSF Activity IDs for Group Management [3006] events.
 *
 * Spec: https://schema.ocsf.io/1.6.0/classes/group_management
 */
enum GroupManagementActivityId: int
{
  case Zero = 0;
  case One = 1;
  case Two = 2;
  case Three = 3;
  case Four = 4;
  case Five = 5;
  case Six = 6;
  case Seven = 7;
  case Eight = 8;
  case Nine = 9;
  case NinetyNine = 99;
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * OCSF Activity IDs for Entity Management [3004] events.
 *
 * Spec: https://schema.ocsf.io/1.6.0/classes/entity_management
 */
enum EntityManagementActivityId: int
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
  case Ten = 10;
  case Eleven = 11;
  case Twelve = 12;
  case Thirteen = 13;
  case NinetyNine = 99;
}

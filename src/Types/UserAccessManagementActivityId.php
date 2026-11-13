<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * OCSF Activity IDs for User Access Management [3005] events.
 *
 * Spec: https://schema.ocsf.io/1.6.0/classes/user_access_management
 */
enum UserAccessManagementActivityId: int
{
  case Zero = 0;
  case One = 1;
  case Two = 2;
  case NinetyNine = 99;
}

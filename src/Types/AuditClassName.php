<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * OCSF event classes emitted in audit logs.
 */
enum AuditClassName: string
{
  case AccountChange = 'Account Change';
  case Authentication = 'Authentication';
  case EntityManagement = 'Entity Management';
  case UserAccessManagement = 'User Access Management';
  case GroupManagement = 'Group Management';
}

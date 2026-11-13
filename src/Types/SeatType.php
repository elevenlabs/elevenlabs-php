<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Seat types for workspace members.
 */
enum SeatType: string
{
  case WorkspaceAdmin = 'workspace_admin';
  case WorkspaceMember = 'workspace_member';
  case WorkspaceLiteMember = 'workspace_lite_member';
}

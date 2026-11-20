<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Team\Members\Types;

/**
 * The member's new role.
 */
enum BodySmbUpdateTeamMemberRoleRole: string
{
  case WorkspaceAdmin = 'workspace_admin';
  case WorkspaceMember = 'workspace_member';
}

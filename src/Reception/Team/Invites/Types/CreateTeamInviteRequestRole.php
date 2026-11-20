<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Team\Invites\Types;

/**
 * The role the invitee joins with: 'workspace_admin' or 'workspace_member'.
 */
enum CreateTeamInviteRequestRole: string
{
  case WorkspaceAdmin = 'workspace_admin';
  case WorkspaceMember = 'workspace_member';
}

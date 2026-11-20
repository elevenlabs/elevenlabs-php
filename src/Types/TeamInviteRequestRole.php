<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The role the invitee joins with: 'workspace_admin' or 'workspace_member'.
 */
enum TeamInviteRequestRole: string
{
  case WorkspaceAdmin = 'workspace_admin';
  case WorkspaceMember = 'workspace_member';
}

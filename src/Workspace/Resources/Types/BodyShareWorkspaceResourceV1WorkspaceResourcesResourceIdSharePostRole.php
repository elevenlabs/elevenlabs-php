<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\Resources\Types;

/**
 * Role to grant to the target: one of 'admin', 'editor', 'commenter', or 'viewer'.
 */
enum BodyShareWorkspaceResourceV1WorkspaceResourcesResourceIdSharePostRole: string
{
  case Admin = 'admin';
  case Editor = 'editor';
  case Commenter = 'commenter';
  case Viewer = 'viewer';
}

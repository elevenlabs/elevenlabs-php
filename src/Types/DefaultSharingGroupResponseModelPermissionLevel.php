<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The permission level to grant to the group
 */
enum DefaultSharingGroupResponseModelPermissionLevel: string
{
  case Admin = 'admin';
  case Editor = 'editor';
  case Viewer = 'viewer';
}

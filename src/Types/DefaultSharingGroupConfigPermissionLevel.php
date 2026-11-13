<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The permission level to grant to the group
 */
enum DefaultSharingGroupConfigPermissionLevel: string
{
  case Admin = 'admin';
  case Editor = 'editor';
  case Viewer = 'viewer';
}

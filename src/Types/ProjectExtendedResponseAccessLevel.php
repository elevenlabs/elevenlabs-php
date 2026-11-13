<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The access level of the project.
 */
enum ProjectExtendedResponseAccessLevel: string
{
  case Admin = 'admin';
  case Editor = 'editor';
  case Commenter = 'commenter';
  case Viewer = 'viewer';
}

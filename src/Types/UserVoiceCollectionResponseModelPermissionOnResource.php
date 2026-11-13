<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The caller's access role on the voice collection.
 */
enum UserVoiceCollectionResponseModelPermissionOnResource: string
{
  case Admin = 'admin';
  case Editor = 'editor';
  case Commenter = 'commenter';
  case Viewer = 'viewer';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ResourceAccessInfoAnonymousAccessLevelOverride: string
{
  case Admin = 'admin';
  case Editor = 'editor';
  case Commenter = 'commenter';
  case Viewer = 'viewer';
}

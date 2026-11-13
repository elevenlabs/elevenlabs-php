<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The role of the user making the request
 */
enum ResourceAccessInfoRole: string
{
  case Admin = 'admin';
  case Editor = 'editor';
  case Commenter = 'commenter';
  case Viewer = 'viewer';
}

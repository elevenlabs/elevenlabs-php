<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ResourceAccessInfoAccessSource: string
{
  case Creator = 'creator';
  case Explicit = 'explicit';
  case WorkspaceAdmin = 'workspace_admin';
  case WorkspaceDefault = 'workspace_default';
}

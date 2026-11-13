<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AgentDeploymentSource: string
{
  case Manual = 'manual';
  case BranchMerge = 'branch_merge';
  case Duplicate = 'duplicate';
}

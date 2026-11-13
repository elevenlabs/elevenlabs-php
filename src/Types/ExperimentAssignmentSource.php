<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ExperimentAssignmentSource: string
{
  case ServerBranch = 'server_branch';
  case ClientDeclared = 'client_declared';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AutoRebaseOutcome: string
{
  case Succeeded = 'succeeded';
  case Conflict = 'conflict';
  case NoCommonAncestor = 'no_common_ancestor';
  case Rejected = 'rejected';
  case Error = 'error';
}

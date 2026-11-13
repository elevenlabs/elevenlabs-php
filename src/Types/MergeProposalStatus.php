<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum MergeProposalStatus: string
{
  case Open = 'open';
  case Merged = 'merged';
  case Closed = 'closed';
}

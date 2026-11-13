<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum MergeProposalCloseReason: string
{
  case Withdrawn = 'withdrawn';
  case Rejected = 'rejected';
  case BranchArchived = 'branch_archived';
}

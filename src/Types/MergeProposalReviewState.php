<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum MergeProposalReviewState: string
{
  case Approved = 'approved';
  case ChangesRequested = 'changes_requested';
}

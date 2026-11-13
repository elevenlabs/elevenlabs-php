<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ReviewResponseModelReviewStatus: string
{
  case Approved = 'approved';
  case EditsRequired = 'edits_required';
  case Rejected = 'rejected';
}

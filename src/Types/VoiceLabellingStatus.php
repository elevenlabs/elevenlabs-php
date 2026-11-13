<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum VoiceLabellingStatus: string
{
  case InReview = 'in_review';
  case ReviewComplete = 'review_complete';
}

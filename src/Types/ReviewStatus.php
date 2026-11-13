<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The review status of the voice.
 */
enum ReviewStatus: string
{
  case NotRequested = 'not_requested';
  case Pending = 'pending';
  case Declined = 'declined';
  case DeclinedResubmittable = 'declined_resubmittable';
  case Allowed = 'allowed';
  case AllowedWithChanges = 'allowed_with_changes';
}

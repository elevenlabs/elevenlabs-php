<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * How a settled call's decision left its lead.
 */
enum DecisionDisposition: string
{
  case Completed = 'completed';
  case RetryQueued = 'retry_queued';
  case CallbackQueued = 'callback_queued';
  case RedirectQueued = 'redirect_queued';
  case Attention = 'attention';
  case Cancelled = 'cancelled';
  case DoNotCall = 'do_not_call';
  case Suppressed = 'suppressed';
  case WindowSuspended = 'window_suspended';
  case AttemptCeilingReached = 'attempt_ceiling_reached';
  case CallbackCeilingReached = 'callback_ceiling_reached';
  case RedirectCeilingReached = 'redirect_ceiling_reached';
  case CallbackTimeInvalid = 'callback_time_invalid';
  case RedirectNumberInvalid = 'redirect_number_invalid';
  case CouldntProcess = 'couldnt_process';
  case SuppressedDoNotCall = 'suppressed_do_not_call';
  case SuppressedAfterStop = 'suppressed_after_stop';
  case PermissionNotGranted = 'permission_not_granted';
  case PermissionDeclined = 'permission_declined';
  case PermissionRequestBlocked = 'permission_request_blocked';
  case PermissionExpired = 'permission_expired';
}

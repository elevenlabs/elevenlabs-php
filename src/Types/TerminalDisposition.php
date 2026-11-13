<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TerminalDisposition: string
{
  case CampaignEnded = 'campaign_ended';
  case Removed = 'removed';
  case DoNotCall = 'do_not_call';
  case Completed = 'completed';
  case Cancelled = 'cancelled';
  case Suppressed = 'suppressed';
  case AttemptCeilingReached = 'attempt_ceiling_reached';
  case CallbackCeilingReached = 'callback_ceiling_reached';
  case RedirectCeilingReached = 'redirect_ceiling_reached';
  case PermissionNotGranted = 'permission_not_granted';
  case PermissionDeclined = 'permission_declined';
  case PermissionRequestBlocked = 'permission_request_blocked';
  case PermissionExpired = 'permission_expired';
  case CallbackTimeInvalid = 'callback_time_invalid';
  case RedirectNumberInvalid = 'redirect_number_invalid';
  case CouldntProcess = 'couldnt_process';
}

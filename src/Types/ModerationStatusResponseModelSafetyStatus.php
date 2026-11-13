<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ModerationStatusResponseModelSafetyStatus: string
{
  case AppealApproved = 'appeal_approved';
  case AppealDenied = 'appeal_denied';
  case FalsePositive = 'false_positive';
}

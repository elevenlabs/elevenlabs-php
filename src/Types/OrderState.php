<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum OrderState: string
{
  case Open = 'open';
  case Submitted = 'submitted';
  case Paid = 'paid';
  case Accepted = 'accepted';
  case Rejected = 'rejected';
  case Done = 'done';
  case Cancelling = 'cancelling';
  case Cancelled = 'cancelled';
  case Expired = 'expired';
  case Merged = 'merged';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ResellerInvoiceLineKind: string
{
  case Plan = 'plan';
  case Telephony = 'telephony';
  case Overage = 'overage';
  case Proration = 'proration';
  case Adjustment = 'adjustment';
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * `open` while the card is still being retried; `void` once retries ran out and the workspace's plan was ended.
 */
enum ResellerInvoiceStatus: string
{
  case Paid = 'paid';
  case Open = 'open';
  case Void = 'void';
}

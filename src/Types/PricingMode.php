<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Whether a catalog item's price and duration are known up front.
 *
 * - `fixed`: the catalog price and duration apply (the default).
 * - `quote`: neither is known until the owner has seen the job. The
 *   receptionist collects intake answers and files a quote request instead
 *   of booking a slot or taking an order.
 */
enum PricingMode: string
{
  case Fixed = 'fixed';
  case Quote = 'quote';
}

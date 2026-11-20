<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * How an order reaches the customer.
 */
enum OrderFulfillmentType: string
{
  case Pickup = 'pickup';
  case Delivery = 'delivery';
  case Digital = 'digital';
}

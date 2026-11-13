<?php

declare(strict_types=1);

namespace ElevenLabs\Productions;

use ElevenLabs\Productions\Orders\OrdersClient;

/**
 * Groups the `productions` resources.
 *
 * It owns no endpoints of its own: every operation lives on one of the clients below, so this class
 * exists only so they are reached as `$client->productions->{child}`.
 */
class ProductionsClient
{
  public OrdersClient $orders;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    $this->orders = new OrdersClient($client, $options);
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\Analytics;

use ElevenLabs\Workspace\Analytics\Requests\RequestsClient;

/**
 * Groups the `analytics` resources.
 *
 * It owns no endpoints of its own: every operation lives on one of the clients below, so this class
 * exists only so they are reached as `$client->analytics->{child}`.
 */
class AnalyticsClient
{
  public RequestsClient $requests;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    $this->requests = new RequestsClient($client, $options);
  }
}

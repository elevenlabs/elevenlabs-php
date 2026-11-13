<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Analytics;

use ElevenLabs\Agents\Analytics\LiveCount\LiveCountClient;

/**
 * Groups the `analytics` resources.
 *
 * It owns no endpoints of its own: every operation lives on one of the clients below, so this class
 * exists only so they are reached as `$client->analytics->{child}`.
 */
class AnalyticsClient
{
  public LiveCountClient $liveCount;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    $this->liveCount = new LiveCountClient($client, $options);
  }
}

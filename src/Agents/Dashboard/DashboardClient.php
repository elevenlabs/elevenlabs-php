<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Dashboard;

use ElevenLabs\Agents\Dashboard\Settings\SettingsClient;

/**
 * Groups the `dashboard` resources.
 *
 * It owns no endpoints of its own: every operation lives on one of the clients below, so this class
 * exists only so they are reached as `$client->dashboard->{child}`.
 */
class DashboardClient
{
  public SettingsClient $settings;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    $this->settings = new SettingsClient($client, $options);
  }
}

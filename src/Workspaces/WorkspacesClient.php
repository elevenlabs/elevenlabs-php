<?php

declare(strict_types=1);

namespace ElevenLabs\Workspaces;

use ElevenLabs\Workspaces\ApiKeys\ApiKeysClient;

/**
 * Groups the `workspaces` resources.
 *
 * It owns no endpoints of its own: every operation lives on one of the clients below, so this class
 * exists only so they are reached as `$client->workspaces->{child}`.
 */
class WorkspacesClient
{
  public ApiKeysClient $apiKeys;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    $this->apiKeys = new ApiKeysClient($client, $options);
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Tokens;

use ElevenLabs\Tokens\SingleUse\SingleUseClient;

/**
 * Groups the `tokens` resources.
 *
 * It owns no endpoints of its own: every operation lives on one of the clients below, so this class
 * exists only so they are reached as `$client->tokens->{child}`.
 */
class TokensClient
{
  public SingleUseClient $singleUse;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    $this->singleUse = new SingleUseClient($client, $options);
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Samples;

use ElevenLabs\Voices\Samples\Audio\AudioClient;

/**
 * Groups the `samples` resources.
 *
 * It owns no endpoints of its own: every operation lives on one of the clients below, so this class
 * exists only so they are reached as `$client->samples->{child}`.
 */
class SamplesClient
{
  public AudioClient $audio;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    $this->audio = new AudioClient($client, $options);
  }
}

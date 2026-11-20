<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Team;

use ElevenLabs\Reception\Team\Members\MembersClient;
use ElevenLabs\Reception\Team\Invites\InvitesClient;

/**
 * Groups the `team` resources.
 *
 * It owns no endpoints of its own: every operation lives on one of the clients below, so this class
 * exists only so they are reached as `$client->team->{child}`.
 */
class TeamClient
{
  public MembersClient $members;
  public InvitesClient $invites;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    $this->members = new MembersClient($client, $options);
    $this->invites = new InvitesClient($client, $options);
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Workspace\Invites\Requests;

use PHPUnit\Framework\TestCase;

class BodyInviteMultipleUsersV1WorkspaceInvitesAddBulkPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "emails": [
            "test-value"
        ],
        "seat_type": "workspace_admin",
        "group_ids": [
            "test-value"
        ],
        "usage_limit": 0
    }
    JSON;

    $instance = \ElevenLabs\Workspace\Invites\Requests\BodyInviteMultipleUsersV1WorkspaceInvitesAddBulkPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

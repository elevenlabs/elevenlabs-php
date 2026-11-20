<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Workspace\Groups\Members\Requests;

use PHPUnit\Framework\TestCase;

class BodyDeleteMemberFromUserGroupV1WorkspaceGroupsGroupIdMembersRemovePostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "email": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Workspace\Groups\Members\Requests\BodyDeleteMemberFromUserGroupV1WorkspaceGroupsGroupIdMembersRemovePost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReceptionTeamInviteResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "email": "test-value",
        "seat_type": "workspace_admin",
        "inviting_user_email": "test-value",
        "created_at_unix": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ReceptionTeamInviteResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

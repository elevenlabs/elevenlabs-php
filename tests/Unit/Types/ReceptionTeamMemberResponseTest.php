<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReceptionTeamMemberResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "user_id": "test-value",
        "email": "test-value",
        "first_name": "test-value",
        "is_owner": true,
        "is_admin": true,
        "picture_url": "test-value",
        "is_suspended": true
    }
    JSON;

    $instance = \ElevenLabs\Types\ReceptionTeamMemberResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

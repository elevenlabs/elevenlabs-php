<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Workspace\Members\Requests;

use PHPUnit\Framework\TestCase;

class UpdateMemberRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "email": "test-value",
        "is_locked": true,
        "workspace_role": "workspace_admin",
        "workspace_seat_type": "workspace_admin",
        "allow_downgrade_to_basic_seat": true
    }
    JSON;

    $instance = \ElevenLabs\Workspace\Members\Requests\UpdateMemberRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

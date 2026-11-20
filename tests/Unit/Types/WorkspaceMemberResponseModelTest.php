<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkspaceMemberResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "user_id": "test-value",
        "email": "test-value",
        "first_name": "test-value",
        "seat_type": "workspace_admin",
        "is_owner": true,
        "is_locked": true
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkspaceMemberResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

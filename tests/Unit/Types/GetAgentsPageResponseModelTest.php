<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetAgentsPageResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agents": [
            {
                "agent_id": "test-value",
                "name": "test-value",
                "voice_id": "test-value",
                "tags": [
                    "test-value"
                ],
                "created_at_unix_secs": 1,
                "updated_at_unix_secs": 1,
                "access_info": {
                    "is_creator": true,
                    "creator_name": "test-value",
                    "creator_email": "test-value",
                    "role": "admin",
                    "anonymous_access_level_override": "admin",
                    "access_source": "creator"
                },
                "last_call_time_unix_secs": 1,
                "archived": true
            }
        ],
        "next_cursor": "test-value",
        "has_more": true
    }
    JSON;

    $instance = \ElevenLabs\Types\GetAgentsPageResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

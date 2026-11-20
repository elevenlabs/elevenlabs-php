<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class RealtimeConversationGroupsResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "conversation_groups": [
            {
                "id": "test-value",
                "title": "test-value",
                "description": "test-value",
                "access_info": {
                    "is_creator": true,
                    "creator_name": "test-value",
                    "creator_email": "test-value",
                    "role": "admin",
                    "anonymous_access_level_override": "admin",
                    "access_source": "creator"
                },
                "sharing": {
                    "people_count": 1,
                    "shared_with_everyone": true,
                    "everyone_role": "admin"
                },
                "created_at_unix_secs": 1
            }
        ],
        "next_cursor": "test-value",
        "has_more": true
    }
    JSON;

    $instance = \ElevenLabs\Types\RealtimeConversationGroupsResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

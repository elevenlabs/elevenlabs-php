<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class RealtimeConversationGroupResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
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
    JSON;

    $instance = \ElevenLabs\Types\RealtimeConversationGroupResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

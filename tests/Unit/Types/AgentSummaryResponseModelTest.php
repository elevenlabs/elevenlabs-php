<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentSummaryResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
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
    JSON;

    $instance = \ElevenLabs\Types\AgentSummaryResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

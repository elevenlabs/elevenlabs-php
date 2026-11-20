<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReceptionAgentInfoResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "business_name": "test-value",
        "business_country": "test-value",
        "business_description": "test-value",
        "timezone": "test-value",
        "currency": "USD",
        "operating_hours": {
            "hours": {
                "key": [
                    {
                        "start_hour": 0,
                        "start_minute": 0,
                        "end_hour": 0,
                        "end_minute": 0
                    }
                ]
            },
            "timezone": "test-value"
        },
        "tool_call_sound": "typing",
        "id": "test-value",
        "created_at_unix": 1,
        "updated_at_unix": 1,
        "workspace_now": {
            "today": {
                "year": 2026,
                "month": 1,
                "day": 1
            },
            "hour": 0,
            "minute": 0,
            "fetched_at_ms": 1
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ReceptionAgentInfoResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReceptionLocationInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "address": "test-value",
        "notes": "test-value",
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
        "customer_facing_name": "test-value",
        "max_concurrent_appointments": 1,
        "id": "test-value",
        "deactivated_at_unix": 1,
        "deactivation_reason": "tier_downgrade"
    }
    JSON;

    $instance = \ElevenLabs\Types\ReceptionLocationInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

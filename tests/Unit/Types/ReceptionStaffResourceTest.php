<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReceptionStaffResourceTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "groups": [
            {
                "label": "test-value",
                "rank": 0
            }
        ],
        "ungrouped_rank": 0,
        "name": "test-value",
        "description": "test-value",
        "is_active": true,
        "email": "test-value",
        "phone": "test-value",
        "sms_notifications_opted_in": true,
        "photo_url": "test-value",
        "location_id": "test-value",
        "working_hours": {
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
        "display_on_booking_page": true,
        "customer_facing_name": "test-value",
        "id": "test-value",
        "created_at_unix": 1,
        "updated_at_unix": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ReceptionStaffResource::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

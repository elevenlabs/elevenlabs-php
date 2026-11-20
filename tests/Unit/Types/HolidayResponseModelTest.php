<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class HolidayResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "start_date": {
            "year": 2026,
            "month": 1,
            "day": 1
        },
        "end_date": {
            "year": 2026,
            "month": 1,
            "day": 1
        },
        "holiday_type": "closed",
        "override_hours": [
            {
                "start_hour": 0,
                "start_minute": 0,
                "end_hour": 0,
                "end_minute": 0
            }
        ],
        "time_off_type": "staff",
        "resource_id": "test-value",
        "location_id": "test-value",
        "reason": "test-value",
        "id": "test-value",
        "created_at_unix": 1,
        "updated_at_unix": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\HolidayResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

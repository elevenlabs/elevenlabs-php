<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReceptionServiceUpdateResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "service": {
            "pricing_mode": "fixed",
            "intake_questions": [
                {
                    "id": "test-value",
                    "label": "test-value",
                    "kind": "text",
                    "options": [
                        "test-value"
                    ],
                    "required": true,
                    "is_active": true
                }
            ],
            "groups": [
                {
                    "label": "test-value",
                    "rank": 0
                }
            ],
            "ungrouped_rank": 0,
            "name": "test-value",
            "description": "test-value",
            "variants": [
                {
                    "id": "test-value",
                    "duration_minutes": 43200,
                    "price": 0,
                    "is_active": true
                }
            ],
            "kind": "classic",
            "buffer_minutes": 0,
            "service_location": "business",
            "add_ons": [
                {
                    "id": "test-value",
                    "name": "test-value",
                    "description": "test-value",
                    "add_duration_minutes": 0,
                    "add_price": 0
                }
            ],
            "max_participants": 2,
            "capacity": 1,
            "is_active": true,
            "any_staff_member": true,
            "staff_ids": [
                "test-value"
            ],
            "asset_ids": [
                "test-value"
            ],
            "advance_booking_minutes": 0,
            "location_ids": [
                "test-value"
            ],
            "display_on_booking_page": true,
            "travel_minutes": 0,
            "travel_before": true,
            "travel_after": true,
            "promotions": [
                {
                    "id": "test-value",
                    "name": "test-value",
                    "target": "service",
                    "variant_id": "test-value",
                    "add_on_id": "test-value",
                    "promotional_price": 0,
                    "days_of_week": [
                        0
                    ],
                    "start_date": "test-value",
                    "end_date": "test-value",
                    "is_active": true
                }
            ],
            "id": "test-value",
            "created_at_unix": 1,
            "updated_at_unix": 1,
            "duration_minutes": 1,
            "price": 1
        },
        "has_affected_events": true
    }
    JSON;

    $instance = \ElevenLabs\Types\ReceptionServiceUpdateResponse::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

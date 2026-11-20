<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReceptionProductTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
        "price": 0,
        "is_active": true,
        "orderable": true,
        "allowed_fulfillment_types": [
            "pickup"
        ],
        "location_ids": [
            "test-value"
        ],
        "stock": {
            "key": 0
        },
        "id": "test-value",
        "created_at_unix": 1,
        "updated_at_unix": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ReceptionProduct::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

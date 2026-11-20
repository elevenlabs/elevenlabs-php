<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReceptionServiceScrapableTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "pricing_mode": "fixed",
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
        "max_participants": 2
    }
    JSON;

    $instance = \ElevenLabs\Types\ReceptionServiceScrapable::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

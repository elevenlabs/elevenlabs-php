<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReceptionServicePromotionTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
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
    JSON;

    $instance = \ElevenLabs\Types\ReceptionServicePromotion::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ListOrdersResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "orders": [
            {
                "order_id": "test-value",
                "name": "test-value",
                "state": "open",
                "total_amount_usd": 1,
                "sandbox": true,
                "submitted_at": "2023-01-01T12:34:56Z",
                "updated_at": "2023-01-01T12:34:56Z",
                "cancel_reason": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ListOrdersResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

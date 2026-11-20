<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class OrderResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "order_id": "test-value",
        "name": "test-value",
        "state": "open",
        "items": [
            {
                "item_id": "test-value",
                "item": {
                    "kind": "dub",
                    "media_id": "test-value",
                    "source_language": "test-value",
                    "destination_languages": [
                        "test-value"
                    ],
                    "include_captions": true,
                    "include_source_captions": true,
                    "instructions": "test-value",
                    "captions_sdh": true
                },
                "quote": {
                    "amount_usd": 1
                }
            }
        ],
        "total_amount_usd": 1,
        "sandbox": true,
        "created_at": "2023-01-01T12:34:56Z",
        "submitted_at": "2023-01-01T12:34:56Z",
        "paid_at": "2023-01-01T12:34:56Z",
        "accepted_at": "2023-01-01T12:34:56Z",
        "completed_at": "2023-01-01T12:34:56Z",
        "cancel_reason": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\OrderResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

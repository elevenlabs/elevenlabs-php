<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class OrderItemInfoTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
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
    JSON;

    $instance = \ElevenLabs\Types\OrderItemInfo::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

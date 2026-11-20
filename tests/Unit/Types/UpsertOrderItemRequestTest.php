<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class UpsertOrderItemRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
        "item_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\UpsertOrderItemRequest::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

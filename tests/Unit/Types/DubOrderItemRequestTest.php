<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DubOrderItemRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
    }
    JSON;

    $instance = \ElevenLabs\Types\DubOrderItemRequest::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

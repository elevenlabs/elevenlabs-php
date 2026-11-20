<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SegmentCreatePayloadTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "start_time": 1,
        "end_time": 1,
        "text": "test-value",
        "translations": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\SegmentCreatePayload::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SegmentUpdatePayloadTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "start_time": 1,
        "end_time": 1,
        "text": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\SegmentUpdatePayload::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

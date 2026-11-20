<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VideoKeyMomentTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "timestamp_ms": 1,
        "type": "test-value",
        "description": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\VideoKeyMoment::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

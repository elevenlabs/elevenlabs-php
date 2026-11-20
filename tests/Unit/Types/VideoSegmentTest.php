<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VideoSegmentTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "start_ms": 1,
        "end_ms": 1,
        "description": "test-value",
        "subjects": [
            "test-value"
        ],
        "shot_type": "test-value",
        "camera_movement": "test-value",
        "transition_in": "test-value",
        "has_speech": true,
        "has_music": true,
        "pacing": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\VideoSegment::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

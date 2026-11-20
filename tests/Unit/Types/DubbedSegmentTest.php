<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DubbedSegmentTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "start_time": 1,
        "end_time": 1,
        "text": "test-value",
        "subtitles": [
            {
                "start_time": 1,
                "end_time": 1,
                "lines": [
                    "test-value"
                ]
            }
        ],
        "audio_stale": true,
        "media_ref": {
            "src": "test-value",
            "content_type": "test-value",
            "bucket_name": "test-value",
            "random_path_slug": "test-value",
            "duration_secs": 1,
            "is_audio": true,
            "url": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\DubbedSegment::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

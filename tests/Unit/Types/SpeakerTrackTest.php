<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SpeakerTrackTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "media_ref": {
            "src": "test-value",
            "content_type": "test-value",
            "bucket_name": "test-value",
            "random_path_slug": "test-value",
            "duration_secs": 1,
            "is_audio": true,
            "url": "test-value"
        },
        "speaker_name": "test-value",
        "voices": {
            "key": "test-value"
        },
        "segments": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\SpeakerTrack::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

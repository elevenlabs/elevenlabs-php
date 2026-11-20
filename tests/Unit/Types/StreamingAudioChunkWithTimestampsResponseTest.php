<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class StreamingAudioChunkWithTimestampsResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "audio_base64": "test-value",
        "alignment": {
            "characters": [
                "test-value"
            ],
            "character_start_times_seconds": [
                1
            ],
            "character_end_times_seconds": [
                1
            ]
        },
        "normalized_alignment": {
            "characters": [
                "test-value"
            ],
            "character_start_times_seconds": [
                1
            ],
            "character_end_times_seconds": [
                1
            ]
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\StreamingAudioChunkWithTimestampsResponse::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

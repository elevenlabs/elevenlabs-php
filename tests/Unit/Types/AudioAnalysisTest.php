<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AudioAnalysisTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "status": "processing",
        "data": {
            "title": "test-value",
            "description": "test-value",
            "content_type": "test-value",
            "overall_pacing": "test-value",
            "segments": [
                {
                    "start_ms": 1,
                    "end_ms": 1,
                    "description": "test-value",
                    "segment_type": "test-value",
                    "has_speech": true,
                    "has_music": true,
                    "pacing": "test-value"
                }
            ],
            "key_moments": [
                {
                    "timestamp_ms": 1,
                    "type": "test-value",
                    "description": "test-value"
                }
            ]
        },
        "updated_at_ms": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\AudioAnalysis::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

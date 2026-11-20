<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VideoAnalysisTest extends TestCase
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
            "subjects": [
                {
                    "name": "test-value",
                    "description": "test-value"
                }
            ],
            "segments": [
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

    $instance = \ElevenLabs\Types\VideoAnalysis::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

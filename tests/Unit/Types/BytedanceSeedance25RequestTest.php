<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class BytedanceSeedance25RequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "webhook": {
            "type": "all"
        },
        "model_id": "bytedance-seedance-v2.5",
        "prompt": "test-value",
        "aspect_ratio": "auto",
        "resolution": "480p",
        "duration_secs": 4,
        "generate_audio": true,
        "start_frame": {
            "type": "generation",
            "generation_id": "test-value"
        },
        "end_frame": {
            "type": "generation",
            "generation_id": "test-value"
        },
        "images": [
            {
                "type": "generation",
                "generation_id": "test-value"
            }
        ],
        "videos": [
            {
                "type": "generation",
                "generation_id": "test-value"
            }
        ],
        "audios": [
            {
                "type": "generation",
                "generation_id": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\BytedanceSeedance25Request::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class Veo31RequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "webhook": {
            "type": "all"
        },
        "prompt": "test-value",
        "negative_prompt": "test-value",
        "seed": 1,
        "enhance_prompt": true,
        "duration_secs": 4,
        "aspect_ratio": "16:9",
        "resolution": "720p",
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
                "image": {
                    "type": "generation",
                    "generation_id": "test-value"
                },
                "role": "subject"
            }
        ],
        "model_id": "veo-3.1-generate-001"
    }
    JSON;

    $instance = \ElevenLabs\Types\Veo31Request::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

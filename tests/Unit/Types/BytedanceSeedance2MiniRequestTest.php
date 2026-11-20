<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class BytedanceSeedance2MiniRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "webhook": {
            "type": "all"
        },
        "prompt": "test-value",
        "aspect_ratio": "auto",
        "duration_secs": 4,
        "seed": 1,
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
        ],
        "model_id": "bytedance-seedance-v2-mini",
        "resolution": "480p"
    }
    JSON;

    $instance = \ElevenLabs\Types\BytedanceSeedance2MiniRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

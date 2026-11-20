<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class BytedanceSeedream5ProRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "webhook": {
            "type": "all"
        },
        "prompt": "test-value",
        "images": [
            {
                "type": "generation",
                "generation_id": "test-value"
            }
        ],
        "aspect_ratio": "auto",
        "seed": 1,
        "model_id": "bytedance-seedream-5-pro",
        "resolution": "1K"
    }
    JSON;

    $instance = \ElevenLabs\Types\BytedanceSeedream5ProRequest::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

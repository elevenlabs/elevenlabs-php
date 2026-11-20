<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GptImage15RequestTest extends TestCase
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
        "mask": {
            "type": "generation",
            "generation_id": "test-value"
        },
        "quality": "low",
        "background": "transparent",
        "aspect_ratio": "1:1",
        "model_id": "gpt-image-1.5"
    }
    JSON;

    $instance = \ElevenLabs\Types\GptImage15Request::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

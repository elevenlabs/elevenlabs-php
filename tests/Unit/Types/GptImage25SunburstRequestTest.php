<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GptImage25SunburstRequestTest extends TestCase
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
        "model_id": "gpt-image-2.5-sunburst",
        "aspect_ratio": "auto",
        "resolution": "1K"
    }
    JSON;

    $instance = \ElevenLabs\Types\GptImage25SunburstRequest::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

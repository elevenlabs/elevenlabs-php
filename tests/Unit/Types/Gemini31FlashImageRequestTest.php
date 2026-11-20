<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class Gemini31FlashImageRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "webhook": {
            "type": "all"
        },
        "prompt": "test-value",
        "model_id": "gemini-3.1-flash-image",
        "images": [
            {
                "type": "generation",
                "generation_id": "test-value"
            }
        ],
        "aspect_ratio": "auto",
        "resolution": "512"
    }
    JSON;

    $instance = \ElevenLabs\Types\Gemini31FlashImageRequest::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

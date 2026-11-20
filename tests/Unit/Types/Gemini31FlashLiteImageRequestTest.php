<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class Gemini31FlashLiteImageRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "webhook": {
            "type": "all"
        },
        "prompt": "test-value",
        "model_id": "gemini-3.1-flash-lite-image",
        "images": [
            {
                "type": "generation",
                "generation_id": "test-value"
            }
        ],
        "aspect_ratio": "auto",
        "resolution": "1K"
    }
    JSON;

    $instance = \ElevenLabs\Types\Gemini31FlashLiteImageRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

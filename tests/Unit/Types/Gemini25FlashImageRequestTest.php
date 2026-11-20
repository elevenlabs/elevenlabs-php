<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class Gemini25FlashImageRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "webhook": {
            "type": "all"
        },
        "prompt": "test-value",
        "model_id": "gemini-2.5-flash-image",
        "images": [
            {
                "type": "generation",
                "generation_id": "test-value"
            }
        ],
        "aspect_ratio": "auto"
    }
    JSON;

    $instance = \ElevenLabs\Types\Gemini25FlashImageRequest::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

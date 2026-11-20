<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ImageAnalysisTest extends TestCase
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
            "mood_and_style": "test-value",
            "composition_notes": "test-value",
            "visible_text": "test-value",
            "subjects": [
                {
                    "name": "test-value",
                    "description": "test-value"
                }
            ]
        },
        "updated_at_ms": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ImageAnalysis::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

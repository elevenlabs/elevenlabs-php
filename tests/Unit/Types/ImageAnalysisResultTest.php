<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ImageAnalysisResultTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
    }
    JSON;

    $instance = \ElevenLabs\Types\ImageAnalysisResult::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

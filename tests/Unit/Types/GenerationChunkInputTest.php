<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GenerationChunkInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "text": "test-value",
        "duration_ms": 3000,
        "positive_styles": [
            "test-value"
        ],
        "negative_styles": [
            "test-value"
        ],
        "context_adherence": "low",
        "conditioning_ref": {
            "song_id": "test-value",
            "range": {
                "start_ms": 1,
                "end_ms": 1
            }
        },
        "condition_strength": "low"
    }
    JSON;

    $instance = \ElevenLabs\Types\GenerationChunkInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SubtitleOrderItemRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "kind": "subtitles",
        "media_ids": [
            "test-value"
        ],
        "source_language": "test-value",
        "destination_languages": [
            "test-value"
        ],
        "cue_options": {
            "min_duration_ms": 2000,
            "max_duration_ms": 4000,
            "max_lines_per_cue": 1,
            "max_chars_per_line": 16,
            "max_chars_per_s": 15,
            "min_gap_between_cues_frames": 0
        },
        "sdh": true,
        "instructions": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\SubtitleOrderItemRequest::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

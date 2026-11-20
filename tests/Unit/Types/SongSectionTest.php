<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SongSectionTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "section_name": "test-value",
        "positive_local_styles": [
            "test-value"
        ],
        "negative_local_styles": [
            "test-value"
        ],
        "duration_ms": 3000,
        "lines": [
            "test-value"
        ],
        "source_from": {
            "song_id": "test-value",
            "range": {
                "start_ms": 1,
                "end_ms": 1
            },
            "negative_ranges": [
                {
                    "start_ms": 1,
                    "end_ms": 1
                }
            ]
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\SongSection::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

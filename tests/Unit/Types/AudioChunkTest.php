<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AudioChunkTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "audio": "test-value",
        "alignment": {
            "chars": [
                "test-value"
            ],
            "char_start_times_ms": [
                1
            ],
            "char_durations_ms": [
                1
            ]
        },
        "normalized_alignment": {
            "chars": [
                "test-value"
            ],
            "char_start_times_ms": [
                1
            ],
            "char_durations_ms": [
                1
            ]
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\AudioChunk::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

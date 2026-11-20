<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AudioOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "audio": "test-value",
        "is_final": true,
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
        },
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
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\AudioOutput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

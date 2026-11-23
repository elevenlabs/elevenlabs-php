<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AudioResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "audio_event": {
            "audio_base_64": "test-value",
            "event_id": 1,
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
            "is_final": true
        },
        "type": "audio"
    }
    JSON;

    $instance = \ElevenLabs\Types\AudioResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

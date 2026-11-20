<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class OpenAiAudioInputConfigOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "format": {
            "type": "audio/pcm",
            "rate": 1
        },
        "transcription": {
            "language": "test-value"
        },
        "turn_detection": {
            "type": "semantic_vad",
            "eagerness": "low",
            "create_response": true,
            "interrupt_response": true,
            "threshold": 1,
            "prefix_padding_ms": 1,
            "silence_duration_ms": 1,
            "turn_timeout": 1
        },
        "pacing": "realtime"
    }
    JSON;

    $instance = \ElevenLabs\Types\OpenAiAudioInputConfigOutput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

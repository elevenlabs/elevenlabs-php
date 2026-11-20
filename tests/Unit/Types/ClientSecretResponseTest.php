<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ClientSecretResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "value": "test-value",
        "expires_at": 1,
        "session": {
            "type": "realtime",
            "model": "eleven_realtime_v1_mini",
            "instructions": "test-value",
            "output_modalities": [
                "test-value"
            ],
            "audio": {
                "input": {
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
                },
                "output": {
                    "format": {
                        "type": "audio/pcm"
                    },
                    "voice": "test-value"
                }
            },
            "tools": [
                {
                    "type": "function",
                    "name": "test-value",
                    "description": "test-value",
                    "parameters": {
                        "key": "test-value"
                    }
                }
            ],
            "tool_choice": "test-value",
            "temperature": 1,
            "max_response_output_tokens": 1,
            "max_duration_seconds": 60,
            "tracing": "auto"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ClientSecretResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

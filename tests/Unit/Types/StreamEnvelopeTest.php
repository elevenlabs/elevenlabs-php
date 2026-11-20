<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class StreamEnvelopeTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "conversation_id": "test-value",
        "turn_id": "test-value",
        "created_at_unix_ms": 1,
        "event": {
            "type": "stream_ended",
            "stream_ended_event": {
                "status": "in_progress",
                "error": {
                    "type": "test-value",
                    "code": "test-value",
                    "message": "test-value"
                },
                "required_actions": [
                    {
                        "type": "client_tool_call",
                        "tool_call_id": "test-value",
                        "tool_name": "test-value",
                        "parameters": {
                            "key": "test-value"
                        }
                    }
                ]
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\StreamEnvelope::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationTurnTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "turn_id": "test-value",
        "status": "in_progress",
        "output": [
            {
                "type": "text",
                "role": "agent",
                "id": "test-value",
                "text": "test-value",
                "created_at_unix_ms": 1
            }
        ],
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
        ],
        "stream_cursor": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationTurn::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

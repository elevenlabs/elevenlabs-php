<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentToolRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agent_tool_request": {
            "tool_name": "test-value",
            "tool_call_id": "test-value",
            "tool_type": "test-value",
            "event_id": 1,
            "expects_response": true,
            "disable_interruptions": true,
            "response_timeout_secs": 1,
            "execution_mode": "test-value"
        },
        "type": "agent_tool_request"
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentToolRequest::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

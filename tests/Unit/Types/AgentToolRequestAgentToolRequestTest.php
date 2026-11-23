<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentToolRequestAgentToolRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "tool_name": "test-value",
        "tool_call_id": "test-value",
        "tool_type": "test-value",
        "event_id": 1,
        "expects_response": true,
        "disable_interruptions": true,
        "response_timeout_secs": 1,
        "execution_mode": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentToolRequestAgentToolRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

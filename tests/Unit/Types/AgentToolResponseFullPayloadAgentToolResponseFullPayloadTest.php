<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentToolResponseFullPayloadAgentToolResponseFullPayloadTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "tool_name": "test-value",
        "tool_call_id": "test-value",
        "tool_type": "test-value",
        "is_error": true,
        "is_blocked": true,
        "event_id": 1,
        "is_called": true,
        "full_tool_result": "test-value",
        "truncated": true,
        "status": "success"
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentToolResponseFullPayloadAgentToolResponseFullPayload::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

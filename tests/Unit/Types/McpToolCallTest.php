<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class McpToolCallTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "mcp_tool_call": {
            "service_id": "test-value",
            "tool_call_id": "test-value",
            "tool_name": "test-value",
            "tool_description": "test-value",
            "parameters": {
                "key": "test-value"
            },
            "timestamp": "test-value",
            "state": "loading"
        },
        "type": "mcp_tool_call"
    }
    JSON;

    $instance = \ElevenLabs\Types\McpToolCall::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

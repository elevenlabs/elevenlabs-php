<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationHistoryTranscriptToolCallMcpDetailsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "mcp",
        "mcp_server_id": "test-value",
        "mcp_server_name": "test-value",
        "integration_type": "test-value",
        "parameters": {
            "key": "test-value"
        },
        "approval_policy": "test-value",
        "requires_approval": true,
        "mcp_tool_name": "test-value",
        "mcp_tool_description": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationHistoryTranscriptToolCallMcpDetails::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

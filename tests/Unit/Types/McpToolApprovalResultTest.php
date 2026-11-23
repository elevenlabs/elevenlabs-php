<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class McpToolApprovalResultTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "mcp_tool_approval_result",
        "tool_call_id": "test-value",
        "is_approved": true
    }
    JSON;

    $instance = \ElevenLabs\Types\McpToolApprovalResult::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\McpServers\ToolApprovals\Requests;

use PHPUnit\Framework\TestCase;

class McpToolAddApprovalRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "tool_name": "test-value",
        "tool_description": "test-value",
        "input_schema": {
            "key": "test-value"
        },
        "approval_policy": "auto_approved"
    }
    JSON;

    $instance = \ElevenLabs\Agents\McpServers\ToolApprovals\Requests\McpToolAddApprovalRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class McpConnectionStatusMcpConnectionStatusTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "integrations": [
            {
                "integration_id": "test-value",
                "integration_type": "mcp_server",
                "is_connected": true,
                "tool_count": 1
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\McpConnectionStatusMcpConnectionStatus::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

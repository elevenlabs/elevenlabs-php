<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class McpConnectionStatusTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "mcp_connection_status": {
            "integrations": [
                {
                    "integration_id": "test-value",
                    "integration_type": "mcp_server",
                    "is_connected": true,
                    "tool_count": 1
                }
            ]
        },
        "type": "mcp_connection_status"
    }
    JSON;

    $instance = \ElevenLabs\Types\McpConnectionStatus::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

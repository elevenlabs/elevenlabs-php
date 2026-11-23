<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class McpToolCallMcpToolCallFailureTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "service_id": "test-value",
        "tool_call_id": "test-value",
        "tool_name": "test-value",
        "tool_description": "test-value",
        "parameters": {
            "key": "test-value"
        },
        "timestamp": "test-value",
        "state": "failure",
        "error_message": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\McpToolCallMcpToolCallFailure::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

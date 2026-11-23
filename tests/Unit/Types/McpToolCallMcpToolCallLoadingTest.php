<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class McpToolCallMcpToolCallLoadingTest extends TestCase
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
        "state": "loading"
    }
    JSON;

    $instance = \ElevenLabs\Types\McpToolCallMcpToolCallLoading::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

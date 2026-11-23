<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ClientToolCallTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "client_tool_call": {
            "tool_name": "test-value",
            "tool_call_id": "test-value",
            "parameters": {
                "key": "test-value"
            },
            "event_id": 1,
            "expects_response": true
        },
        "type": "client_tool_call"
    }
    JSON;

    $instance = \ElevenLabs\Types\ClientToolCall::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

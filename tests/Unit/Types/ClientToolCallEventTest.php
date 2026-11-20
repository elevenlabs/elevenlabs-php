<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ClientToolCallEventTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "client_tool_call",
        "client_tool_call": {
            "tool_name": "test-value",
            "tool_call_id": "test-value",
            "parameters": {
                "key": "test-value"
            },
            "event_id": 1,
            "expects_response": true
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ClientToolCallEvent::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

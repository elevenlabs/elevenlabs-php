<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentReasoningResponsePartClientEventTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "reasoning_response_part": {
            "text": "test-value",
            "type": "start",
            "event_id": 1
        },
        "type": "agent_reasoning_response_part"
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentReasoningResponsePartClientEvent::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

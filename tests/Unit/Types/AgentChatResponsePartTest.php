<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentChatResponsePartTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "text_response_part": {
            "text": "test-value",
            "type": "start",
            "event_id": 1,
            "response_id": "test-value"
        },
        "type": "agent_chat_response_part"
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentChatResponsePart::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

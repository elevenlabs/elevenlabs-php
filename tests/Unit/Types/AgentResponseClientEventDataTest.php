<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentResponseClientEventDataTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agent_response": "test-value",
        "event_id": 1,
        "response_id": "test-value",
        "in_response_to_ids": [
            "test-value"
        ],
        "response_type": "text",
        "attachments": [
            {
                "url": "test-value",
                "name": "test-value",
                "mime_type": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentResponseClientEventData::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

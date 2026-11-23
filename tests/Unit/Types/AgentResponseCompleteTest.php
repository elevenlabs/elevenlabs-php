<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentResponseCompleteTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agent_response_complete_event": {
            "event_id": 1
        },
        "type": "agent_response_complete"
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentResponseComplete::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

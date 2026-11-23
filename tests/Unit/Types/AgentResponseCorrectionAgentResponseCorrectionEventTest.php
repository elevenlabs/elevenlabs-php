<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentResponseCorrectionAgentResponseCorrectionEventTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "original_agent_response": "test-value",
        "corrected_agent_response": "test-value",
        "event_id": 1,
        "response_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentResponseCorrectionAgentResponseCorrectionEvent::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

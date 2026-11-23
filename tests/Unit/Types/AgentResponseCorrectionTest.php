<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentResponseCorrectionTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agent_response_correction_event": {
            "original_agent_response": "test-value",
            "corrected_agent_response": "test-value",
            "event_id": 1,
            "response_id": "test-value"
        },
        "type": "agent_response_correction"
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentResponseCorrection::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

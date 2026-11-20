<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkflowStandaloneAgentNodeModelInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "standalone_agent",
        "position": {
            "x": 1,
            "y": 1
        },
        "edge_order": [
            "test-value"
        ],
        "agent_id": "test-value",
        "branch_id": "test-value",
        "node_id": "test-value",
        "delay_ms": 1,
        "transfer_message": "test-value",
        "enable_transferred_agent_first_message": true,
        "preserve_client_tts_overrides": true,
        "preserve_voice_settings": true
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkflowStandaloneAgentNodeModelInput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

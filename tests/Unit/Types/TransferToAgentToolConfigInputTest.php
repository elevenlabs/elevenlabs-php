<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TransferToAgentToolConfigInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "system_tool_type": "transfer_to_agent",
        "transfers": [
            {
                "agent_id": "test-value",
                "branch_id": "test-value",
                "node_id": "test-value",
                "condition": "test-value",
                "delay_ms": 1,
                "transfer_message": "test-value",
                "enable_transferred_agent_first_message": true,
                "is_workflow_node_transfer": true,
                "preserve_client_tts_overrides": true,
                "preserve_voice_settings": true
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\TransferToAgentToolConfigInput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

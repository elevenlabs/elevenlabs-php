<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TransferToAgentToolResultSuccessModelInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result_type": "transfer_to_agent_success",
        "status": "success",
        "from_agent": "test-value",
        "to_agent": "test-value",
        "to_node": "test-value",
        "condition": "test-value",
        "delay_ms": 1,
        "transfer_message": "test-value",
        "enable_transferred_agent_first_message": true,
        "branch_info": {
            "branch_reason": "configured",
            "branch_id": "test-value"
        },
        "preserve_client_tts_overrides": true,
        "preserve_voice_settings": true
    }
    JSON;

    $instance = \ElevenLabs\Types\TransferToAgentToolResultSuccessModelInput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

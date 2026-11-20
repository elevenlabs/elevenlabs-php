<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationHistorySipTrunkingPhoneCallModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "direction": "inbound",
        "phone_number_id": "test-value",
        "agent_number": "test-value",
        "external_number": "test-value",
        "call_result": "answered",
        "type": "sip_trunking",
        "call_id": "test-value",
        "call_sid": "test-value",
        "sip_header_dynamic_variables": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationHistorySipTrunkingPhoneCallModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

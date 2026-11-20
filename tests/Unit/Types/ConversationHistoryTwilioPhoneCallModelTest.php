<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationHistoryTwilioPhoneCallModelTest extends TestCase
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
        "type": "twilio",
        "stream_sid": "test-value",
        "call_sid": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationHistoryTwilioPhoneCallModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

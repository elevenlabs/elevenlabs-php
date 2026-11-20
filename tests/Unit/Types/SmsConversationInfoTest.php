<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SmsConversationInfoTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "direction": "inbound",
        "phone_number_id": "test-value",
        "sms_user_phone_number": "test-value",
        "agent_phone_number": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\SmsConversationInfo::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CreateTwilioPhoneNumberRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "phone_number": "test-value",
        "label": "test-value",
        "supports_inbound": true,
        "supports_outbound": true,
        "provider": "twilio",
        "agent_id": "test-value",
        "sid": "test-value",
        "token": "test-value",
        "account_auth_token": "test-value",
        "region_config": {
            "region_id": "us1",
            "token": "test-value",
            "edge_location": "ashburn"
        },
        "enable_sms": true
    }
    JSON;

    $instance = \ElevenLabs\Types\CreateTwilioPhoneNumberRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

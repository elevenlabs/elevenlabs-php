<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ListWhatsAppAccountsResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "items": [
            {
                "business_account_id": "test-value",
                "phone_number_id": "test-value",
                "business_account_name": "test-value",
                "phone_number_name": "test-value",
                "phone_number": "test-value",
                "account_type": "cloud_api",
                "assigned_agent_id": "test-value",
                "enable_messaging": true,
                "enable_audio_message_response": true,
                "enable_typing_indicator": true,
                "assigned_agent_name": "test-value",
                "is_token_expired": true
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ListWhatsAppAccountsResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

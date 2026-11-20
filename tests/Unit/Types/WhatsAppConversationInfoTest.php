<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WhatsAppConversationInfoTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "direction": "inbound",
        "whatsapp_phone_number_id": "test-value",
        "whatsapp_user_id": "test-value",
        "awaiting_first_user_message": true,
        "recipient": {
            "phone": "test-value",
            "bsuid": "test-value"
        },
        "call_permission_request": {
            "state": "blocked",
            "requested_at_unix": 1,
            "responded_at_unix": 1,
            "permanent": true,
            "granted_by_user_call": true
        },
        "call_result": "answered",
        "opening_message": {
            "template_name": "test-value",
            "wamid": "test-value",
            "sent_at_unix": 1,
            "delivered_at_unix": 1,
            "read_at_unix": 1,
            "replied_at_unix": 1,
            "failed_at_unix": 1,
            "error_code": "test-value",
            "pricing_category": "test-value",
            "billable": true
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\WhatsAppConversationInfo::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

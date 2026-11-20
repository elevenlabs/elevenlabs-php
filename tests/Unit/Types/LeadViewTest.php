<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class LeadViewTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "lead_id": "test-value",
        "recipient_id": "test-value",
        "phone_number": "test-value",
        "phone_numbers": [
            "test-value"
        ],
        "phone_numbers_index": 1,
        "user_id": "test-value",
        "attempt_count": 1,
        "failure_count": 1,
        "callback_count": 1,
        "redirect_count": 1,
        "do_not_call": true,
        "terminal_disposition": "campaign_ended",
        "created_at_unix": 1,
        "updated_at_unix": 1,
        "dynamic_variables": {
            "key": "test-value"
        },
        "overrides": {
            "language": "test-value",
            "first_message": "test-value",
            "prompt": "test-value",
            "voice_id": "test-value"
        },
        "delivery": {
            "status": "pending",
            "stage": "queued",
            "sent_at_unix": 1,
            "delivered_at_unix": 1,
            "read_at_unix": 1,
            "replied_at_unix": 1,
            "failed_at_unix": 1,
            "error_message": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\LeadView::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

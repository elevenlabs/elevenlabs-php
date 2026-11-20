<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CallViewTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "intent_id": "test-value",
        "lead_id": "test-value",
        "intent_type": "initial",
        "cold_attempt": 1,
        "status": "queued",
        "phone_number": "test-value",
        "scheduled_time_unix": 1,
        "conversation_id": "test-value",
        "outcome": "pending",
        "call_result": "answered",
        "outcome_at_unix": 1,
        "decision_disposition": "completed",
        "collected_dynamic_variables": {
            "key": "test-value"
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

    $instance = \ElevenLabs\Types\CallView::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

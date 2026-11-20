<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkspaceBatchCallsResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "batch_calls": [
            {
                "id": "test-value",
                "phone_number_id": "test-value",
                "phone_provider": "twilio",
                "whatsapp_params": {
                    "whatsapp_phone_number_id": "test-value",
                    "whatsapp_call_permission_request_template_name": "test-value",
                    "whatsapp_call_permission_request_template_language_code": "test-value"
                },
                "name": "test-value",
                "agent_id": "test-value",
                "branch_id": "test-value",
                "environment": "test-value",
                "created_at_unix": 1,
                "scheduled_time_unix": 1,
                "timezone": "test-value",
                "total_calls_dispatched": 1,
                "total_calls_scheduled": 1,
                "total_calls_finished": 1,
                "last_updated_at_unix": 1,
                "status": "pending",
                "retry_count": 1,
                "telephony_call_config": {
                    "ringing_timeout_secs": 1,
                    "twilio_call_recording_enabled": true,
                    "twilio_machine_detection": {
                        "mode": "enable",
                        "actions": [
                            {
                                "action": "hang_up",
                                "answered_by": [
                                    "human"
                                ]
                            }
                        ]
                    }
                },
                "target_concurrency_limit": 1,
                "agent_name": "test-value",
                "branch_name": "test-value"
            }
        ],
        "next_doc": "test-value",
        "has_more": true
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkspaceBatchCallsResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

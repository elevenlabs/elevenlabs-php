<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CampaignResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "campaign_id": "test-value",
        "call_name": "test-value",
        "agent_id": "test-value",
        "channel_config": {
            "channel": "phone",
            "agent_phone_number_id": "test-value",
            "mode_config": {
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
                },
                "mode": "voice"
            }
        },
        "status": "active",
        "policy": {
            "timezone": "test-value",
            "retry": {
                "retry_delay_seconds": 1,
                "max_short_retries": 0,
                "max_total_calls": 1,
                "max_callbacks": 0,
                "max_redirects": 0,
                "interval_placement": "start",
                "rotate_step_seconds": 1,
                "max_consecutive_failures_per_number": 1
            },
            "calling_periods": [
                {
                    "weekdays": [
                        1
                    ],
                    "intervals": [
                        {
                            "start": "test-value",
                            "end": "test-value"
                        }
                    ]
                }
            ],
            "date_overrides": [
                {
                    "start_date": "test-value",
                    "end_date": "test-value",
                    "intervals": [
                        {
                            "start": "test-value",
                            "end": "test-value"
                        }
                    ],
                    "name": "test-value"
                }
            ],
            "data_collection": {
                "callback_time": "test-value",
                "redirect_phone_number": "test-value",
                "stop": "test-value",
                "mappings": {
                    "key": "test-value"
                }
            },
            "followup_context": {
                "call_type": true,
                "previous_conversation_id": true,
                "previous_summary": true,
                "previous_transcript": true
            }
        },
        "variant": "simple",
        "source": "ui",
        "created_at_unix": 1,
        "scheduled_time_unix": 1,
        "updated_at_unix": 1,
        "branch_id": "test-value",
        "environment": "test-value",
        "target_concurrency_limit": 1,
        "channel": "phone",
        "mode": "voice",
        "counts": {
            "leads": 1,
            "terminal_leads": 1,
            "open_attention": 1,
            "delivery": {
                "sent": 1,
                "delivered": 1,
                "read": 1,
                "replied": 1,
                "failed": 1
            }
        },
        "agent_name": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\CampaignResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

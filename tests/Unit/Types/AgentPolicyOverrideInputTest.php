<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentPolicyOverrideInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
                    0
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
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentPolicyOverrideInput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

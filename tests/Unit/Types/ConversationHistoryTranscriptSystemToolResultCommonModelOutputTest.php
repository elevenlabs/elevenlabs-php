<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationHistoryTranscriptSystemToolResultCommonModelOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "request_id": "test-value",
        "tool_name": "test-value",
        "tool_id": "test-value",
        "result_value": "test-value",
        "is_error": true,
        "is_blocked": true,
        "tool_has_been_called": true,
        "tool_latency_secs": 1,
        "error_type": "test-value",
        "raw_error_message": "test-value",
        "dynamic_variable_updates": [
            {
                "variable_name": "test-value",
                "old_value": "test-value",
                "new_value": "test-value",
                "updated_at": 1,
                "tool_name": "test-value",
                "tool_request_id": "test-value"
            }
        ],
        "type": "system",
        "result": {
            "result_type": "end_call_success",
            "status": "success",
            "reason": "test-value",
            "message": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationHistoryTranscriptSystemToolResultCommonModelOutput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

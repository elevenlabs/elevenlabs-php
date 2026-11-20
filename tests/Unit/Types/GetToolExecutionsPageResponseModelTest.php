<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetToolExecutionsPageResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "executions": [
            {
                "tool_id": "test-value",
                "tool_request_id": "test-value",
                "conversation_id": "test-value",
                "agent_id": "test-value",
                "branch_id": "test-value",
                "timestamp": 1,
                "latency_secs": 1,
                "is_error": true,
                "request_payload": "test-value",
                "response_payload": "test-value",
                "error_message": "test-value",
                "error_type": "test-value",
                "id": "test-value",
                "tool_call_details": {
                    "type": "webhook",
                    "method": "test-value",
                    "url": "test-value",
                    "headers": {
                        "key": "test-value"
                    },
                    "path_params": {
                        "key": "test-value"
                    },
                    "query_params": {
                        "key": "test-value"
                    },
                    "body": "test-value"
                }
            }
        ],
        "next_cursor": "test-value",
        "has_more": true
    }
    JSON;

    $instance = \ElevenLabs\Types\GetToolExecutionsPageResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

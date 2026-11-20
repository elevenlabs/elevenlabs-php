<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkflowToolNestedToolsStepModelInputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "step_latency_secs": 1,
        "type": "nested_tools",
        "node_id": "test-value",
        "requests": [
            {
                "type": "system",
                "request_id": "test-value",
                "tool_name": "test-value",
                "tool_id": "test-value",
                "params_as_json": "test-value",
                "tool_has_been_called": true,
                "tool_details": {
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
        "results": [
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
                "type": "client"
            }
        ],
        "is_successful": true
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkflowToolNestedToolsStepModelInput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

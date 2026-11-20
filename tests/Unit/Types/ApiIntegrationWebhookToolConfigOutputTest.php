<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ApiIntegrationWebhookToolConfigOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "api_integration_webhook",
        "name": "test-value",
        "description": "test-value",
        "response_timeout_secs": 5,
        "disable_interruptions": true,
        "interruption_mode": "allow",
        "force_pre_tool_speech": true,
        "pre_tool_speech": "auto",
        "assignments": [
            {
                "source": "response",
                "dynamic_variable": "test-value",
                "value_path": "test-value",
                "sanitize": true,
                "preserve_native_type": true
            }
        ],
        "tool_call_sound": "typing",
        "tool_call_sound_behavior": "auto",
        "tool_error_handling_mode": "auto",
        "dynamic_variables": {
            "dynamic_variable_placeholders": {
                "key": "test-value"
            }
        },
        "execution_mode": "immediate",
        "tool_version": "test-value",
        "api_integration_id": "test-value",
        "api_integration_connection_id": "test-value",
        "api_schema_overrides": {
            "schema_overrides": {
                "key": {
                    "source": "constant",
                    "constant_value": "test-value"
                }
            },
            "response_filter_mode": "all",
            "response_filters": [
                "test-value"
            ],
            "request_headers": {
                "key": "test-value"
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\ApiIntegrationWebhookToolConfigOutput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

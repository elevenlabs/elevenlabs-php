<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class McpToolConfigOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "mcp",
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
        "integration_type": "mcp_server",
        "parameters": {
            "description": "test-value",
            "dynamic_variable": "test-value",
            "constant_value": {
                "key": "test-value"
            },
            "is_omitted": true,
            "type": "object",
            "required": [
                "test-value"
            ],
            "properties": {
                "key": {
                    "type": "boolean",
                    "description": "test-value",
                    "enum": [
                        "test-value"
                    ],
                    "is_system_provided": true,
                    "dynamic_variable": "test-value",
                    "allowed_values": {
                        "dynamic_variable": "test-value"
                    },
                    "allowed_values_dynamic_variable": "test-value",
                    "constant_value": "test-value",
                    "is_omitted": true
                }
            },
            "required_constraints": {
                "any_of": [
                    {
                        "required": [
                            "test-value"
                        ]
                    }
                ],
                "all_of": [
                    {
                        "required": [
                            "test-value"
                        ]
                    }
                ]
            }
        },
        "approval_policy": "auto_approve_all",
        "mcp_tool_name": "test-value",
        "mcp_tool_description": "test-value",
        "mcp_server_id": "test-value",
        "mcp_server_name": "test-value",
        "mcp_input_schema": {
            "key": "test-value"
        },
        "execution_mode": "immediate",
        "input_overrides": {
            "key": {
                "source": "constant",
                "constant_value": "test-value"
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\McpToolConfigOutput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

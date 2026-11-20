<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class McpServersResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "mcp_servers": [
            {
                "id": "test-value",
                "config": {
                    "approval_policy": "auto_approve_all",
                    "tool_approval_hashes": [
                        {
                            "tool_name": "test-value",
                            "tool_hash": "test-value",
                            "approval_policy": "auto_approved"
                        }
                    ],
                    "transport": "SSE",
                    "url": "test-value",
                    "secret_token": {
                        "secret_id": "test-value"
                    },
                    "request_headers": {
                        "key": "test-value"
                    },
                    "request_meta": {
                        "key": "test-value"
                    },
                    "auth_connection": {
                        "auth_connection_id": "test-value"
                    },
                    "name": "test-value",
                    "description": "test-value",
                    "force_pre_tool_speech": true,
                    "pre_tool_speech": "auto",
                    "disable_interruptions": true,
                    "interruption_mode": "allow",
                    "tool_call_sound": "typing",
                    "tool_call_sound_behavior": "auto",
                    "execution_mode": "immediate",
                    "response_timeout_secs": 5,
                    "tool_config_overrides": [
                        {
                            "tool_name": "test-value",
                            "force_pre_tool_speech": true,
                            "pre_tool_speech": "auto",
                            "disable_interruptions": true,
                            "interruption_mode": "allow",
                            "tool_call_sound": "typing",
                            "tool_call_sound_behavior": "auto",
                            "execution_mode": "immediate",
                            "response_timeout_secs": 5,
                            "assignments": [
                                {
                                    "source": "response",
                                    "dynamic_variable": "test-value",
                                    "value_path": "test-value",
                                    "sanitize": true,
                                    "preserve_native_type": true
                                }
                            ],
                            "input_overrides": {
                                "key": {
                                    "source": "constant",
                                    "constant_value": "test-value"
                                }
                            },
                            "response_mocks": [
                                {
                                    "parameter_conditions": [
                                        {
                                            "eval": {
                                                "type": "llm",
                                                "description": "test-value"
                                            },
                                            "path": "test-value"
                                        }
                                    ],
                                    "mock_result": "test-value",
                                    "is_error": true
                                }
                            ]
                        }
                    ],
                    "disable_compression": true
                },
                "access_info": {
                    "is_creator": true,
                    "creator_name": "test-value",
                    "creator_email": "test-value",
                    "role": "admin",
                    "anonymous_access_level_override": "admin",
                    "access_source": "creator"
                },
                "dependent_agents": [
                    {
                        "referenced_resource_ids": [
                            "test-value"
                        ],
                        "id": "test-value",
                        "name": "test-value",
                        "type": "available",
                        "created_at_unix_secs": 1,
                        "access_level": "admin"
                    }
                ],
                "metadata": {
                    "created_at": 1,
                    "owner_user_id": "test-value"
                }
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\McpServersResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

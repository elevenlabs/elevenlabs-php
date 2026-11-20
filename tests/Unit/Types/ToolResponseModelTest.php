<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ToolResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "tool_config": {
            "type": "webhook",
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
            "api_schema": {
                "request_headers": {
                    "key": "test-value"
                },
                "url": "test-value",
                "method": "GET",
                "path_params_schema": {
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
                "query_params_schema": {
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
                    "required": [
                        "test-value"
                    ]
                },
                "request_body_schema": {
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
                "response_body_schema": {
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
                "response_filter": {
                    "mode": "all",
                    "filters": [
                        "test-value"
                    ],
                    "content_type": "application/json"
                },
                "content_type": "application/json",
                "auth_resolved_params": [
                    "test-value"
                ],
                "auth_connection": {
                    "auth_connection_id": "test-value"
                }
            },
            "follow_redirects": true,
            "follow_redirects_allowed_domains": [
                "test-value"
            ]
        },
        "access_info": {
            "is_creator": true,
            "creator_name": "test-value",
            "creator_email": "test-value",
            "role": "admin",
            "anonymous_access_level_override": "admin",
            "access_source": "creator"
        },
        "usage_stats": {
            "total_calls": 1,
            "avg_latency_secs": 1
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
    JSON;

    $instance = \ElevenLabs\Types\ToolResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

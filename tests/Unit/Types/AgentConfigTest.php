<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "first_message": "test-value",
        "language": "test-value",
        "hinglish_mode": true,
        "dynamic_variables": "test-value",
        "disable_first_message_interruptions": true,
        "max_conversation_duration_message": "test-value",
        "text_behavior_overrides": {
            "key": {
                "verbosity": "auto",
                "output_format": "mp3_22050_32",
                "interaction_budget": "realtime"
            }
        },
        "subagent_config": {
            "agents": [
                {
                    "execution_mode": "immediate",
                    "timeout_secs": 10,
                    "agent_id": "test-value",
                    "branch_id": "test-value",
                    "description": "test-value",
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
                    }
                }
            ],
            "self_subagent": {
                "execution_mode": "immediate",
                "timeout_secs": 10,
                "description": "test-value"
            }
        },
        "prompt": {
            "prompt": "test-value",
            "llm": "gpt-4o-mini",
            "reasoning_effort": "none",
            "service_tier": "standard",
            "thinking_budget": 1,
            "enable_reasoning_summary": true,
            "temperature": 1,
            "max_tokens": 1,
            "tool_ids": [
                "test-value"
            ],
            "tool_ids_strict": true,
            "built_in_tools": {
                "transfer_to_agent": {
                    "type": "system",
                    "name": "test-value",
                    "description": "test-value",
                    "response_timeout_secs": 1,
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
                    "params": {
                        "system_tool_type": "end_call"
                    }
                },
                "end_call": {
                    "type": "system",
                    "name": "test-value",
                    "description": "test-value",
                    "response_timeout_secs": 1,
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
                    "params": {
                        "system_tool_type": "end_call"
                    }
                },
                "language_detection": {
                    "type": "system",
                    "name": "test-value",
                    "description": "test-value",
                    "response_timeout_secs": 1,
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
                    "params": {
                        "system_tool_type": "end_call"
                    }
                },
                "transfer_to_number": {
                    "type": "system",
                    "name": "test-value",
                    "description": "test-value",
                    "response_timeout_secs": 1,
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
                    "params": {
                        "system_tool_type": "end_call"
                    }
                },
                "skip_turn": {
                    "type": "system",
                    "name": "test-value",
                    "description": "test-value",
                    "response_timeout_secs": 1,
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
                    "params": {
                        "system_tool_type": "end_call"
                    }
                },
                "play_keypad_touch_tone": {
                    "type": "system",
                    "name": "test-value",
                    "description": "test-value",
                    "response_timeout_secs": 1,
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
                    "params": {
                        "system_tool_type": "end_call"
                    }
                },
                "voicemail_detection": {
                    "type": "system",
                    "name": "test-value",
                    "description": "test-value",
                    "response_timeout_secs": 1,
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
                    "params": {
                        "system_tool_type": "end_call"
                    }
                }
            },
            "enable_parallel_tool_calls": true,
            "mcp_server_ids": [
                "test-value"
            ],
            "native_mcp_server_ids": [
                "test-value"
            ],
            "knowledge_base": [
                {
                    "type": "file",
                    "name": "test-value",
                    "id": "test-value",
                    "usage_mode": "prompt"
                }
            ],
            "custom_llm": {
                "url": "test-value",
                "model_id": "test-value",
                "api_key": {
                    "secret_id": "test-value"
                },
                "auth_connection": {
                    "auth_connection_id": "test-value"
                },
                "request_headers": {
                    "key": "test-value"
                },
                "api_version": "test-value",
                "api_type": "chat_completions"
            },
            "ignore_default_personality": true,
            "rag": {
                "enabled": true,
                "embedding_model": "e5_mistral_7b_instruct",
                "max_vector_distance": 1,
                "max_documents_length": 1,
                "max_retrieved_rag_chunks_count": 20,
                "num_candidates": 10000,
                "query_rewrite_prompt_override": "test-value",
                "knowledge_base_tool_info": {
                    "enabled_strategies": [
                        "cat"
                    ]
                }
            },
            "timezone": "test-value",
            "backup_llm_config": {
                "preference": "default"
            },
            "cascade_timeout_seconds": 2,
            "tools": [
                {
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
                }
            ]
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentConfig::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkflowSayNodeModelOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "say",
        "position": {
            "x": 1,
            "y": 1
        },
        "edge_order": [
            "test-value"
        ],
        "conversation_config": {
            "asr": {
                "quality": "high",
                "provider": "elevenlabs",
                "user_input_audio_format": "pcm_8000",
                "keywords": [
                    "test-value"
                ]
            },
            "turn": {
                "turn_timeout": 1,
                "initial_wait_time": 1,
                "silence_end_call_timeout": 1,
                "turn_eagerness": "patient",
                "spelling_patience": "auto",
                "speculative_turn": true,
                "retranscribe_on_turn_timeout": true,
                "turn_model": "turn_v2",
                "interruption_ignore_terms": [
                    "test-value"
                ],
                "interruption_ignore_term_languages": [
                    "test-value"
                ],
                "merge_with_default_ignore_terms": true,
                "transcribe_on_disabled_interruptions": true,
                "soft_timeout_config": {
                    "timeout_seconds": 1,
                    "message": "test-value",
                    "additional_soft_timeout_messages": [
                        "test-value"
                    ],
                    "use_llm_generated_message": true,
                    "randomize_fillers": true,
                    "max_soft_timeouts_per_generation": 1,
                    "llm_generated_message_prompt_override": "test-value",
                    "disable_until_first_user_message": true
                },
                "noisy_environment_message": "test-value"
            },
            "tts": {
                "model_id": "eleven_turbo_v2",
                "voice_id": "test-value",
                "supported_voices": [
                    {
                        "label": "test-value",
                        "voice_id": "test-value",
                        "description": "test-value",
                        "language": "test-value",
                        "model_family": "turbo",
                        "optimize_streaming_latency": 0,
                        "stability": 0,
                        "speed": 0.7,
                        "similarity_boost": 0,
                        "clone_strength": 0
                    }
                ],
                "expressive_mode": true,
                "suggested_audio_tags": [
                    {
                        "tag": "test-value",
                        "description": "test-value"
                    }
                ],
                "agent_output_audio_format": "pcm_8000",
                "optimize_streaming_latency": 0,
                "stability": 1,
                "speed": 1,
                "similarity_boost": 1,
                "clone_strength": 1,
                "text_normalisation_type": "system_prompt",
                "pronunciation_dictionary_locators": [
                    {
                        "pronunciation_dictionary_id": "test-value",
                        "version_id": "test-value"
                    }
                ],
                "enable_phoneme_tags": true,
                "audio_effects": {
                    "filter_preset_id": "test-value",
                    "distance": 0,
                    "environment_id": "test-value",
                    "background_noise_id": "test-value",
                    "send_level": 0,
                    "pan": -1
                }
            },
            "conversation": {
                "text_only": true,
                "max_duration_seconds": 1,
                "client_events": [
                    "conversation_initiation_metadata"
                ],
                "file_input": {
                    "enabled": true,
                    "max_files_in_memory": 1,
                    "max_files_per_conversation": 1
                },
                "monitoring_enabled": true,
                "monitoring_events": [
                    "conversation_initiation_metadata"
                ],
                "dtmf_input_settings": {
                    "dtmf_input_timeout": 0.5,
                    "hash_terminator": true,
                    "redact_input": true
                },
                "background_sound": {
                    "source_type": "preset",
                    "source_id": "office2",
                    "volume": 1,
                    "crossfade_loop": true
                },
                "source_attribution": true
            },
            "language_presets": {
                "key": {
                    "overrides": {
                        "asr": {
                            "keywords": [
                                "test-value"
                            ]
                        },
                        "turn": {
                            "soft_timeout_config": {
                                "message": "test-value",
                                "additional_soft_timeout_messages": [
                                    "test-value"
                                ]
                            },
                            "noisy_environment_message": "test-value"
                        },
                        "tts": {
                            "model_id": "eleven_turbo_v2",
                            "voice_id": "test-value",
                            "supported_voices": [
                                {
                                    "label": "test-value",
                                    "voice_id": "test-value",
                                    "description": "test-value",
                                    "language": "test-value",
                                    "model_family": "turbo",
                                    "optimize_streaming_latency": 0,
                                    "stability": 0,
                                    "speed": 0.7,
                                    "similarity_boost": 0,
                                    "clone_strength": 0
                                }
                            ],
                            "stability": 1,
                            "speed": 1,
                            "similarity_boost": 1,
                            "clone_strength": 1,
                            "pronunciation_dictionary_locators": [
                                {
                                    "pronunciation_dictionary_id": "test-value",
                                    "version_id": "test-value"
                                }
                            ]
                        },
                        "conversation": {
                            "text_only": true,
                            "max_duration_seconds": 1
                        },
                        "agent": {
                            "first_message": "test-value",
                            "language": "test-value",
                            "max_conversation_duration_message": "test-value",
                            "prompt": {
                                "prompt": "test-value",
                                "llm": "gpt-4o-mini",
                                "reasoning_effort": "none",
                                "tool_ids": [
                                    "test-value"
                                ],
                                "tool_ids_strict": true,
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
                                ]
                            }
                        }
                    },
                    "first_message_translation": {
                        "source_hash": "test-value",
                        "text": "test-value"
                    },
                    "soft_timeout_translation": {
                        "source_hash": "test-value",
                        "text": "test-value"
                    },
                    "noisy_environment_message_translation": {
                        "source_hash": "test-value",
                        "text": "test-value"
                    }
                }
            },
            "agent": {
                "first_message": "test-value",
                "language": "test-value",
                "hinglish_mode": true,
                "dynamic_variables": {
                    "dynamic_variable_placeholders": {
                        "key": "test-value"
                    }
                },
                "disable_first_message_interruptions": true,
                "max_conversation_duration_message": "test-value",
                "text_behavior_overrides": {
                    "key": {
                        "verbosity": "auto",
                        "output_format": "mp3_22050_32",
                        "interaction_budget": "realtime"
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
                        "max_retrieved_rag_chunks_count": 1,
                        "num_candidates": 1,
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
                    "cascade_timeout_seconds": 1,
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
        },
        "additional_prompt": "test-value",
        "additional_knowledge_base": [
            {
                "type": "file",
                "name": "test-value",
                "id": "test-value",
                "usage_mode": "prompt"
            }
        ],
        "additional_tool_ids": [
            "test-value"
        ],
        "label": "test-value",
        "message": {
            "type": "literal",
            "text": "test-value",
            "text_translations": {
                "key": {
                    "value": "test-value"
                }
            }
        },
        "wait_for_speech_completion": true,
        "wait_for_user_response": true
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkflowSayNodeModelOutput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AdhocAgentConfigOverrideForTestRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
                    "pause_after_filler": true,
                    "llm_generated_message_prompt_override": "test-value",
                    "disable_until_first_user_message": true
                },
                "noisy_environment_detection": true,
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
                "stability": 0,
                "speed": 0.7,
                "similarity_boost": 0,
                "clone_strength": 0,
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
                    "volume": 0.01,
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
                        "mtls_auth_connection": {
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
        },
        "platform_settings": {
            "evaluation": {
                "criteria": [
                    {
                        "id": "test-value",
                        "name": "test-value",
                        "type": "prompt",
                        "conversation_goal_prompt": "test-value",
                        "use_knowledge_base": true,
                        "scope": "conversation",
                        "llm": "gpt-4o-mini",
                        "scoring_mode": "binary",
                        "max_score": 1,
                        "score_instructions": "test-value"
                    }
                ]
            },
            "widget": {
                "variant": "tiny",
                "placement": "top-left",
                "expandable": "never",
                "avatar": {
                    "type": "orb",
                    "color_1": "test-value",
                    "color_2": "test-value"
                },
                "feedback_mode": "none",
                "end_feedback": {
                    "type": "rating"
                },
                "bg_color": "test-value",
                "text_color": "test-value",
                "btn_color": "test-value",
                "btn_text_color": "test-value",
                "border_color": "test-value",
                "focus_color": "test-value",
                "border_radius": 1,
                "btn_radius": 1,
                "action_text": "test-value",
                "start_call_text": "test-value",
                "end_call_text": "test-value",
                "expand_text": "test-value",
                "listening_text": "test-value",
                "speaking_text": "test-value",
                "shareable_page_text": "test-value",
                "shareable_page_show_terms": true,
                "terms_text": "test-value",
                "terms_html": "test-value",
                "terms_key": "test-value",
                "show_avatar_when_collapsed": true,
                "disable_banner": true,
                "override_link": "test-value",
                "markdown_link_allowed_hosts": [
                    {
                        "hostname": "test-value"
                    }
                ],
                "markdown_link_include_www": true,
                "markdown_link_allow_http": true,
                "mic_muting_enabled": true,
                "transcript_enabled": true,
                "text_input_enabled": true,
                "conversation_mode_toggle_enabled": true,
                "default_expanded": true,
                "always_expanded": true,
                "dismissible": true,
                "show_agent_status": true,
                "show_conversation_id": true,
                "strip_audio_tags": true,
                "syntax_highlight_theme": "light",
                "text_contents": {
                    "main_label": "test-value",
                    "start_call": "test-value",
                    "start_chat": "test-value",
                    "new_call": "test-value",
                    "end_call": "test-value",
                    "mute_microphone": "test-value",
                    "change_language": "test-value",
                    "collapse": "test-value",
                    "expand": "test-value",
                    "copied": "test-value",
                    "accept_terms": "test-value",
                    "dismiss_terms": "test-value",
                    "listening_status": "test-value",
                    "speaking_status": "test-value",
                    "connecting_status": "test-value",
                    "chatting_status": "test-value",
                    "queue_waiting_status": "test-value",
                    "queue_waiting_status_short": "test-value",
                    "input_label": "test-value",
                    "input_placeholder": "test-value",
                    "input_placeholder_text_only": "test-value",
                    "input_placeholder_new_conversation": "test-value",
                    "user_ended_conversation": "test-value",
                    "agent_ended_conversation": "test-value",
                    "conversation_id": "test-value",
                    "error_occurred": "test-value",
                    "queue_timed_out": "test-value",
                    "copy_id": "test-value",
                    "initiate_feedback": "test-value",
                    "request_follow_up_feedback": "test-value",
                    "thanks_for_feedback": "test-value",
                    "thanks_for_feedback_details": "test-value",
                    "follow_up_feedback_placeholder": "test-value",
                    "submit": "test-value",
                    "go_back": "test-value",
                    "send_message": "test-value",
                    "text_mode": "test-value",
                    "voice_mode": "test-value",
                    "switched_to_text_mode": "test-value",
                    "switched_to_voice_mode": "test-value",
                    "copy": "test-value",
                    "download": "test-value",
                    "wrap": "test-value",
                    "agent_working": "test-value",
                    "agent_done": "test-value",
                    "agent_error": "test-value",
                    "attach_file": "test-value",
                    "remove_file": "test-value",
                    "file_upload_error": "test-value",
                    "file_type_unsupported": "test-value",
                    "file_too_large": "test-value",
                    "file_limit_reached": "test-value",
                    "typing_indicator": "test-value",
                    "rich_content_unavailable": "test-value"
                },
                "styles": {
                    "base": "test-value",
                    "base_hover": "test-value",
                    "base_active": "test-value",
                    "base_border": "test-value",
                    "base_subtle": "test-value",
                    "base_primary": "test-value",
                    "base_error": "test-value",
                    "accent": "test-value",
                    "accent_hover": "test-value",
                    "accent_active": "test-value",
                    "accent_border": "test-value",
                    "accent_subtle": "test-value",
                    "accent_primary": "test-value",
                    "overlay_padding": 1,
                    "button_radius": 1,
                    "input_radius": 1,
                    "bubble_radius": 1,
                    "sheet_radius": 1,
                    "compact_sheet_radius": 1,
                    "dropdown_sheet_radius": 1
                },
                "show_resize_button": true,
                "end_confirmation_enabled": true,
                "mobile_fullscreen": true,
                "transcript_speech_sync_enabled": true,
                "language_selector": true,
                "supports_text_only": true,
                "custom_avatar_path": "test-value",
                "language_presets": {
                    "key": {
                        "text_contents": {
                            "main_label": "test-value",
                            "start_call": "test-value",
                            "start_chat": "test-value",
                            "new_call": "test-value",
                            "end_call": "test-value",
                            "mute_microphone": "test-value",
                            "change_language": "test-value",
                            "collapse": "test-value",
                            "expand": "test-value",
                            "copied": "test-value",
                            "accept_terms": "test-value",
                            "dismiss_terms": "test-value",
                            "listening_status": "test-value",
                            "speaking_status": "test-value",
                            "connecting_status": "test-value",
                            "chatting_status": "test-value",
                            "queue_waiting_status": "test-value",
                            "queue_waiting_status_short": "test-value",
                            "input_label": "test-value",
                            "input_placeholder": "test-value",
                            "input_placeholder_text_only": "test-value",
                            "input_placeholder_new_conversation": "test-value",
                            "user_ended_conversation": "test-value",
                            "agent_ended_conversation": "test-value",
                            "conversation_id": "test-value",
                            "error_occurred": "test-value",
                            "queue_timed_out": "test-value",
                            "copy_id": "test-value",
                            "initiate_feedback": "test-value",
                            "request_follow_up_feedback": "test-value",
                            "thanks_for_feedback": "test-value",
                            "thanks_for_feedback_details": "test-value",
                            "follow_up_feedback_placeholder": "test-value",
                            "submit": "test-value",
                            "go_back": "test-value",
                            "send_message": "test-value",
                            "text_mode": "test-value",
                            "voice_mode": "test-value",
                            "switched_to_text_mode": "test-value",
                            "switched_to_voice_mode": "test-value",
                            "copy": "test-value",
                            "download": "test-value",
                            "wrap": "test-value",
                            "agent_working": "test-value",
                            "agent_done": "test-value",
                            "agent_error": "test-value",
                            "attach_file": "test-value",
                            "remove_file": "test-value",
                            "file_upload_error": "test-value",
                            "file_type_unsupported": "test-value",
                            "file_too_large": "test-value",
                            "file_limit_reached": "test-value",
                            "typing_indicator": "test-value",
                            "rich_content_unavailable": "test-value"
                        },
                        "text_contents_translation": {
                            "source": {
                                "key": "test-value"
                            },
                            "text": {
                                "key": "test-value"
                            }
                        },
                        "terms_text": "test-value",
                        "terms_html": "test-value",
                        "terms_key": "test-value",
                        "terms_translation": {
                            "source_hash": "test-value",
                            "text": "test-value"
                        }
                    }
                }
            },
            "data_collection": {
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
                    "is_omitted": true,
                    "name": "test-value",
                    "llm": "gpt-4o-mini"
                }
            },
            "data_collection_scopes": {
                "key": "conversation"
            },
            "analysis_items": {
                "evaluation_criteria": [
                    {
                        "source": "user",
                        "analysis_item_id": "test-value",
                        "version_id": "test-value",
                        "additional_version_ids": [
                            "test-value"
                        ],
                        "scope": "conversation",
                        "weight": 1
                    }
                ],
                "data_collection": [
                    {
                        "source": "user",
                        "analysis_item_id": "test-value",
                        "version_id": "test-value",
                        "scope": "conversation"
                    }
                ]
            },
            "overrides": {
                "conversation_config_override": {
                    "asr": {
                        "keywords": true
                    },
                    "turn": {
                        "soft_timeout_config": {
                            "message": true,
                            "additional_soft_timeout_messages": true
                        },
                        "noisy_environment_message": true
                    },
                    "tts": {
                        "model_id": true,
                        "voice_id": true,
                        "supported_voices": true,
                        "stability": true,
                        "speed": true,
                        "similarity_boost": true,
                        "clone_strength": true,
                        "pronunciation_dictionary_locators": true
                    },
                    "conversation": {
                        "text_only": true,
                        "max_duration_seconds": true
                    },
                    "agent": {
                        "first_message": true,
                        "language": true,
                        "max_conversation_duration_message": true,
                        "prompt": {
                            "prompt": true,
                            "llm": true,
                            "reasoning_effort": true,
                            "tool_ids": true,
                            "tool_ids_strict": true,
                            "native_mcp_server_ids": true,
                            "knowledge_base": true
                        }
                    }
                },
                "custom_llm_extra_body": true,
                "enable_conversation_initiation_client_data_from_webhook": true,
                "enable_starting_workflow_node_id_from_client": true,
                "enable_procedure_ids_from_client": true
            },
            "workspace_overrides": {
                "conversation_initiation_client_data_webhook": {
                    "url": "test-value",
                    "request_headers": {
                        "key": "test-value"
                    }
                },
                "webhooks": {
                    "post_call_webhook_id": "test-value",
                    "events": [
                        "transcript"
                    ],
                    "transcript_format": "json",
                    "exclude_transcript": true,
                    "send_audio": true
                }
            },
            "testing": {
                "attached_tests": [
                    {
                        "test_id": "test-value",
                        "workflow_node_id": "test-value"
                    }
                ]
            },
            "archived": true,
            "guardrails": {
                "version": "1",
                "focus": {
                    "is_enabled": true
                },
                "prompt_injection": {
                    "is_enabled": true
                },
                "content": {
                    "execution_mode": "streaming",
                    "config": {
                        "sexual": {
                            "is_enabled": true,
                            "threshold": 1
                        },
                        "violence": {
                            "is_enabled": true,
                            "threshold": 1
                        },
                        "harassment": {
                            "is_enabled": true,
                            "threshold": 1
                        },
                        "self_harm": {
                            "is_enabled": true,
                            "threshold": 1
                        },
                        "profanity": {
                            "is_enabled": true,
                            "threshold": 1
                        },
                        "religion_or_politics": {
                            "is_enabled": true,
                            "threshold": 1
                        },
                        "medical_and_legal_information": {
                            "is_enabled": true,
                            "threshold": 1
                        }
                    },
                    "trigger_action": {
                        "type": "end_call"
                    }
                },
                "custom": {
                    "config": {
                        "configs": [
                            {
                                "is_enabled": true,
                                "name": "test-value",
                                "prompt": "test-value",
                                "execution_mode": "streaming",
                                "model": "gemini-2.5-flash-lite",
                                "service_tier": "standard",
                                "history_message_count": 0,
                                "trigger_action": {
                                    "type": "end_call"
                                },
                                "evaluate_full_response_only": true
                            }
                        ]
                    }
                }
            },
            "summary_language": "test-value",
            "auto_translate_transcript_to_app_language": true,
            "auth": {
                "enable_auth": true,
                "allowlist": [
                    {
                        "hostname": "test-value"
                    }
                ],
                "require_origin_header": true,
                "shareable_token": "test-value"
            },
            "call_limits": {
                "agent_concurrency_limit": 1,
                "daily_limit": 1,
                "bursting_enabled": true
            },
            "queueing_config": {
                "enabled": true,
                "wait_timeout_seconds": 1800,
                "hold_audio": {
                    "audio_path": "test-value",
                    "audio_url": "test-value",
                    "original_filename": "test-value",
                    "duration_secs": 1,
                    "size_bytes": 1
                }
            },
            "privacy": {
                "record_voice": true,
                "retention_days": 1,
                "delete_transcript_and_pii": true,
                "delete_audio": true,
                "apply_to_existing_conversations": true,
                "zero_retention_mode": true,
                "conversation_history_redaction": {
                    "enabled": true,
                    "entities": [
                        "name"
                    ],
                    "excluded_data_collection_ids": [
                        "test-value"
                    ]
                }
            },
            "trust_context": "unknown",
            "analysis_llm": "gpt-4o-mini",
            "alerting": {
                "monitor_configs": {
                    "key": {
                        "enabled": true,
                        "threshold": 0,
                        "relative_increase_threshold": 0,
                        "min_failure_count": 1,
                        "min_history_bucket_count": 1,
                        "min_sample_count": 1,
                        "suspect_trigger_threshold": 1,
                        "auto_resolve_after_inactive_minutes": 1
                    }
                },
                "auto_resolve_after_inactive_minutes": 1,
                "environments": [
                    "test-value"
                ],
                "notifiers": [
                    {
                        "type": "webhook",
                        "webhook_id": "test-value"
                    }
                ]
            }
        },
        "workflow": {
            "edges": {
                "key": {
                    "source": "test-value",
                    "target": "test-value",
                    "forward_condition": {
                        "label": "test-value",
                        "type": "unconditional"
                    },
                    "backward_condition": {
                        "label": "test-value",
                        "type": "unconditional"
                    },
                    "reroutes": [
                        {
                            "x": 1,
                            "y": 1
                        }
                    ]
                }
            },
            "nodes": {
                "key": {
                    "type": "start",
                    "position": {
                        "x": 1,
                        "y": 1
                    },
                    "edge_order": [
                        "test-value"
                    ]
                }
            },
            "prevent_subagent_loops": true
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\AdhocAgentConfigOverrideForTestRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

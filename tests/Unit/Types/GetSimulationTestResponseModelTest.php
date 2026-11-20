<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetSimulationTestResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "access_info": {
            "is_creator": true,
            "creator_name": "test-value",
            "creator_email": "test-value",
            "role": "admin",
            "anonymous_access_level_override": "admin",
            "access_source": "creator"
        },
        "from_conversation_metadata": {
            "conversation_id": "test-value",
            "agent_id": "test-value",
            "branch_id": "test-value",
            "workflow_node_id": "test-value",
            "original_agent_reply": [
                {
                    "role": "user",
                    "agent_metadata": {
                        "agent_id": "test-value",
                        "branch_id": "test-value",
                        "workflow_node_id": "test-value",
                        "version_id": "test-value"
                    },
                    "message": "test-value",
                    "multivoice_message": {
                        "parts": [
                            {
                                "text": "test-value",
                                "voice_label": "test-value",
                                "time_in_call_secs": 1
                            }
                        ]
                    },
                    "tool_calls": [
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
                    "tool_results": [
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
                    "feedback": {
                        "score": "like",
                        "time_in_call_secs": 1
                    },
                    "llm_override": "test-value",
                    "producing_llm": "test-value",
                    "time_in_call_secs": 1,
                    "conversation_turn_metrics": {
                        "metrics": {
                            "key": {
                                "elapsed_time": 1
                            }
                        },
                        "convai_asr_provider": "test-value",
                        "convai_tts_model": "test-value",
                        "convai_tts_cascade": "test-value",
                        "voice_id": "test-value"
                    },
                    "rag_retrieval_info": {
                        "chunks": [
                            {
                                "document_id": "test-value",
                                "chunk_id": "test-value",
                                "vector_distance": 1
                            }
                        ],
                        "embedding_model": "e5_mistral_7b_instruct",
                        "retrieval_query": "test-value",
                        "rag_latency_secs": 1,
                        "used_chunk_ids": [
                            "test-value"
                        ]
                    },
                    "llm_usage": {
                        "model_usage": {
                            "key": {
                                "input": {
                                    "tokens": 1,
                                    "price": 1
                                },
                                "input_cache_read": {
                                    "tokens": 1,
                                    "price": 1
                                },
                                "input_cache_write": {
                                    "tokens": 1,
                                    "price": 1
                                },
                                "output_total": {
                                    "tokens": 1,
                                    "price": 1
                                }
                            }
                        }
                    },
                    "interrupted": true,
                    "ignored_as_backchannel": true,
                    "platform_event": "user_turn_timeout",
                    "original_message": "test-value",
                    "reasoning": [
                        {
                            "summary": "test-value",
                            "provider_redact": true
                        }
                    ],
                    "source_medium": "audio",
                    "source_event_id": 1,
                    "used_static_kb_document_ids": [
                        "test-value"
                    ],
                    "user_identifier": "test-value",
                    "id": "test-value",
                    "created_at_unix_ms": 1,
                    "triggered_guardrails": [
                        {
                            "guardrail_type": "custom",
                            "guardrail_name": "test-value",
                            "execution_mode": "streaming",
                            "guardrail_details": {
                                "type": "llm",
                                "rationale": "test-value"
                            }
                        }
                    ]
                }
            ]
        },
        "dynamic_variables": {
            "key": "test-value"
        },
        "chat_history": [
            {
                "role": "user",
                "agent_metadata": {
                    "agent_id": "test-value",
                    "branch_id": "test-value",
                    "workflow_node_id": "test-value",
                    "version_id": "test-value"
                },
                "message": "test-value",
                "multivoice_message": {
                    "parts": [
                        {
                            "text": "test-value",
                            "voice_label": "test-value",
                            "time_in_call_secs": 1
                        }
                    ]
                },
                "tool_calls": [
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
                "tool_results": [
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
                "feedback": {
                    "score": "like",
                    "time_in_call_secs": 1
                },
                "llm_override": "test-value",
                "producing_llm": "test-value",
                "time_in_call_secs": 1,
                "conversation_turn_metrics": {
                    "metrics": {
                        "key": {
                            "elapsed_time": 1
                        }
                    },
                    "convai_asr_provider": "test-value",
                    "convai_tts_model": "test-value",
                    "convai_tts_cascade": "test-value",
                    "voice_id": "test-value"
                },
                "rag_retrieval_info": {
                    "chunks": [
                        {
                            "document_id": "test-value",
                            "chunk_id": "test-value",
                            "vector_distance": 1
                        }
                    ],
                    "embedding_model": "e5_mistral_7b_instruct",
                    "retrieval_query": "test-value",
                    "rag_latency_secs": 1,
                    "used_chunk_ids": [
                        "test-value"
                    ]
                },
                "llm_usage": {
                    "model_usage": {
                        "key": {
                            "input": {
                                "tokens": 1,
                                "price": 1
                            },
                            "input_cache_read": {
                                "tokens": 1,
                                "price": 1
                            },
                            "input_cache_write": {
                                "tokens": 1,
                                "price": 1
                            },
                            "output_total": {
                                "tokens": 1,
                                "price": 1
                            }
                        }
                    }
                },
                "interrupted": true,
                "ignored_as_backchannel": true,
                "platform_event": "user_turn_timeout",
                "original_message": "test-value",
                "reasoning": [
                    {
                        "summary": "test-value",
                        "provider_redact": true
                    }
                ],
                "source_medium": "audio",
                "source_event_id": 1,
                "used_static_kb_document_ids": [
                    "test-value"
                ],
                "user_identifier": "test-value",
                "id": "test-value",
                "created_at_unix_ms": 1,
                "triggered_guardrails": [
                    {
                        "guardrail_type": "custom",
                        "guardrail_name": "test-value",
                        "execution_mode": "streaming",
                        "guardrail_details": {
                            "type": "llm",
                            "rationale": "test-value"
                        }
                    }
                ]
            }
        ],
        "conversation_initiation_source": "unknown",
        "environment": "test-value",
        "type": "simulation",
        "success_condition": "test-value",
        "success_conditions": [
            "test-value"
        ],
        "simulation_scenario": "test-value",
        "simulation_max_turns": 1,
        "simulation_environment": "test-value",
        "tool_mock_config": {
            "mocking_strategy": "all",
            "fallback_strategy": "call_real_tool",
            "mocked_tool_ids": [
                "test-value"
            ]
        },
        "tool_mock_overrides": {
            "key": [
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
        },
        "evaluation_model": "gpt-4o-mini",
        "simulated_user_model": "gpt-4o-mini",
        "id": "test-value",
        "name": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\GetSimulationTestResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentSimulatedChatTestResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "simulated_conversation": [
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
                ],
                "file_input": {
                    "file_id": "test-value",
                    "original_filename": "test-value",
                    "mime_type": "test-value",
                    "file_url": "test-value"
                },
                "file_inputs": [
                    {
                        "file_id": "test-value",
                        "original_filename": "test-value",
                        "mime_type": "test-value",
                        "file_url": "test-value"
                    }
                ],
                "contextual_update_info": {
                    "context_id": "test-value",
                    "is_superseded": true
                },
                "reasoned": true
            }
        ],
        "analysis": {
            "evaluation_criteria_results": {
                "key": {
                    "criteria_id": "test-value",
                    "result": "success",
                    "rationale": "test-value",
                    "scoring_mode": "binary",
                    "score": 1,
                    "max_score": 1
                }
            },
            "data_collection_results": {
                "key": {
                    "data_collection_id": "test-value",
                    "name": "test-value",
                    "value": "test-value",
                    "json_schema": {
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
                    },
                    "rationale": "test-value"
                }
            },
            "evaluation_criteria_results_list": [
                {
                    "criteria_id": "test-value",
                    "result": "success",
                    "rationale": "test-value",
                    "scoring_mode": "binary",
                    "score": 1,
                    "max_score": 1
                }
            ],
            "data_collection_results_list": [
                {
                    "data_collection_id": "test-value",
                    "name": "test-value",
                    "value": "test-value",
                    "json_schema": {
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
                    },
                    "rationale": "test-value"
                }
            ],
            "call_successful": "success",
            "call_success_score": 1,
            "transcript_summary": "test-value",
            "call_summary_title": "test-value",
            "scoped": [
                {
                    "scope": "conversation",
                    "source_agent_id": "test-value",
                    "source_branch_id": "test-value",
                    "evaluation_criteria_results": {
                        "key": {
                            "criteria_id": "test-value",
                            "result": "success",
                            "rationale": "test-value",
                            "scoring_mode": "binary",
                            "score": 1,
                            "max_score": 1
                        }
                    },
                    "data_collection_results": {
                        "key": {
                            "data_collection_id": "test-value",
                            "name": "test-value",
                            "value": "test-value",
                            "json_schema": {
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
                            },
                            "rationale": "test-value"
                        }
                    },
                    "successful": "success",
                    "success_score": 1
                }
            ]
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentSimulatedChatTestResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

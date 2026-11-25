<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class UnitTestRunResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "test_run_id": "test-value",
        "test_info": {
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
                                    },
                                    "output_total_reasoning_portion": {
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
                                },
                                "output_total_reasoning_portion": {
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
            "type": "llm",
            "success_condition": "test-value",
            "success_examples": [
                {
                    "response": "test-value",
                    "type": "success"
                }
            ],
            "failure_examples": [
                {
                    "response": "test-value",
                    "type": "failure"
                }
            ]
        },
        "test_invocation_id": "test-value",
        "agent_id": "test-value",
        "branch_id": "test-value",
        "version_id": "test-value",
        "ran_against_draft": true,
        "workflow_node_id": "test-value",
        "status": "pending",
        "agent_responses": [
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
                            },
                            "output_total_reasoning_portion": {
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
        "test_id": "test-value",
        "test_name": "test-value",
        "condition_result": {
            "result": "success",
            "rationale": {
                "messages": [
                    "test-value"
                ],
                "summary": "test-value"
            }
        },
        "last_updated_at_unix": 1,
        "metadata": {
            "workspace_id": "test-value",
            "test_name": "test-value",
            "ran_by_user_email": "test-value",
            "test_type": "llm"
        },
        "root_folder_id": "test-value",
        "root_folder_name": "test-value",
        "environment": "test-value",
        "credits_used": 1,
        "charging": {
            "dev_discount": true,
            "is_burst": true,
            "tier": "test-value",
            "llm_usage": {
                "irreversible_generation": {
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
                            },
                            "output_total_reasoning_portion": {
                                "tokens": 1,
                                "price": 1
                            }
                        }
                    }
                },
                "initiated_generation": {
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
                            },
                            "output_total_reasoning_portion": {
                                "tokens": 1,
                                "price": 1
                            }
                        }
                    }
                }
            },
            "llm_price": 1,
            "llm_charge": 1,
            "call_charge": 1,
            "platform_charge": 1,
            "platform_usage": {
                "category_usage": {
                    "key": {
                        "credits": 1,
                        "price": 1,
                        "quantity": 1
                    }
                }
            },
            "platform_price": 1,
            "free_minutes_consumed": 1,
            "free_llm_dollars_consumed": 1,
            "tts_usage": {
                "primary_tts_model": "test-value",
                "total_audio_output_seconds": 1,
                "total_characters": 1,
                "per_voice_usage": [
                    {
                        "voice_id": "test-value",
                        "audio_output_seconds": 1
                    }
                ]
            },
            "asr_usage": {
                "asr_model": "test-value",
                "total_transcription_calls": 1,
                "total_audio_input_seconds": 1
            },
            "analysis": {
                "total": {
                    "price": 1,
                    "charge": 1,
                    "runs": 1,
                    "price_per_feature": {
                        "key": 1
                    },
                    "charge_per_feature": {
                        "key": 1
                    }
                },
                "last_run": {
                    "price": 1,
                    "charge": 1,
                    "price_per_feature": {
                        "key": 1
                    },
                    "charge_per_feature": {
                        "key": 1
                    }
                }
            },
            "voice_surcharge_charge": 1
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\UnitTestRunResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}

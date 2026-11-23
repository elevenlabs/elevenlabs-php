<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Tests\Invocations;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class InvocationsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "meta": {
              "total": 1,
              "page": 1,
              "page_size": 1
          },
          "results": [
              {
                  "id": "test-value",
                  "name": "test-value",
                  "agent_id": "test-value",
                  "branch_id": "test-value",
                  "version_id": "test-value",
                  "ran_against_draft": true,
                  "runs_diverged_from_version": true,
                  "created_at_unix_secs": 1,
                  "test_run_count": 1,
                  "passed_count": 1,
                  "failed_count": 1,
                  "pending_count": 1,
                  "cancelled_count": 1,
                  "title": "test-value",
                  "access_info": {
                      "is_creator": true,
                      "creator_name": "test-value",
                      "creator_email": "test-value",
                      "role": "admin",
                      "anonymous_access_level_override": "admin",
                      "access_source": "creator"
                  },
                  "repeat_count": 1,
                  "cancelled": true,
                  "credits_used": 1,
                  "total_price": 1
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->tests->invocations->list(
      request: new \ElevenLabs\Agents\Tests\Invocations\Requests\ListInvocationsRequest([
        'agentId' => 'agent_id',
        'branchId' => 'branch_id',
        'createdByUserId' => 'created_by_user_id',
        'testId' => 'test_id',
        'startTime' => 1,
        'endTime' => 8,
        'versionId' => 'version_id',
        'pageSize' => 30,
        'search' => 'search',
        'cursor' => 'cursor'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/test-invocations$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "name": "test-value",
          "agent_id": "test-value",
          "branch_id": "test-value",
          "version_id": "test-value",
          "ran_against_draft": true,
          "created_at": 1,
          "folder_id": "test-value",
          "repeat_count": 1,
          "cancelled": true,
          "bucketing_status": "pending",
          "result_groups": [
              {
                  "test_id": "test-value",
                  "test_name": "test-value",
                  "workflow_node_id": "test-value",
                  "buckets": [
                      {
                          "test_run_ids": [
                              "test-value"
                          ],
                          "title": "test-value",
                          "reason": "test-value",
                          "status": "pending"
                      }
                  ]
              }
          ],
          "test_runs": [
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
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->tests->invocations->get(testInvocationId: 'test_invocation_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/test-invocations/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "name": "test-value",
          "agent_id": "test-value",
          "branch_id": "test-value",
          "version_id": "test-value",
          "ran_against_draft": true,
          "created_at": 1,
          "folder_id": "test-value",
          "repeat_count": 1,
          "cancelled": true,
          "bucketing_status": "pending",
          "result_groups": [
              {
                  "test_id": "test-value",
                  "test_name": "test-value",
                  "workflow_node_id": "test-value",
                  "buckets": [
                      {
                          "test_run_ids": [
                              "test-value"
                          ],
                          "title": "test-value",
                          "reason": "test-value",
                          "status": "pending"
                      }
                  ]
              }
          ],
          "test_runs": [
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
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\Tests\Invocations\Requests\UpdateTestSuiteInvocationRequestModel(
      [
        'name' => 'name'
      ]
    );
    $sdk->agents->tests->invocations->update(
      request: $request,
      testInvocationId: 'test_invocation_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/test-invocations/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testCancelSendsWireRequest(): void
  {
    $transport = $this->transport(204, '');
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->tests->invocations->cancel(testInvocationId: 'test_invocation_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/test-invocations/[^/]+/cancel$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testResubmitSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $asrQuality = \ElevenLabs\Types\AsrQuality::High->value;

    $asrProvider = \ElevenLabs\Types\AsrProvider::Elevenlabs->value;

    $asrInputFormat = \ElevenLabs\Types\AsrInputFormat::Pcm8000->value;

    $asrConversationalConfig = new \ElevenLabs\Types\AsrConversationalConfig([
      'quality' => $asrQuality,
      'provider' => $asrProvider,
      'userInputAudioFormat' => $asrInputFormat,
      'keywords' => []
    ]);

    $turnEagerness = \ElevenLabs\Types\TurnEagerness::Patient->value;

    $spellingPatience = \ElevenLabs\Types\SpellingPatience::Auto->value;

    $turnModel = \ElevenLabs\Types\TurnModel::TurnV2->value;

    $softTimeoutConfig = new \ElevenLabs\Types\SoftTimeoutConfig([
      'timeoutSeconds' => -1,
      'message' => 'Hhmmmm...yeah.',
      'additionalSoftTimeoutMessages' => [],
      'useLlmGeneratedMessage' => true,
      'randomizeFillers' => false,
      'maxSoftTimeoutsPerGeneration' => 1,
      'llmGeneratedMessagePromptOverride' => 'llm_generated_message_prompt_override',
      'disableUntilFirstUserMessage' => false
    ]);

    $turnConfig = new \ElevenLabs\Types\TurnConfig([
      'turnTimeout' => 7,
      'initialWaitTime' => 0.63,
      'silenceEndCallTimeout' => -1,
      'turnEagerness' => $turnEagerness,
      'spellingPatience' => $spellingPatience,
      'speculativeTurn' => false,
      'retranscribeOnTurnTimeout' => true,
      'turnModel' => $turnModel,
      'interruptionIgnoreTerms' => [],
      'interruptionIgnoreTermLanguages' => [],
      'mergeWithDefaultIgnoreTerms' => false,
      'transcribeOnDisabledInterruptions' => true,
      'softTimeoutConfig' => $softTimeoutConfig,
      'noisyEnvironmentDetection' => true,
      'noisyEnvironmentMessage' =>
        "Uhh ... sorry, I\'m picking up some noise in the background. Could you move somewhere quieter?"
    ]);

    $ttsConversationalModel = \ElevenLabs\Types\TtsConversationalModel::ElevenTurboV2->value;

    $ttsModelFamily = \ElevenLabs\Types\TtsModelFamily::Turbo->value;

    $ttsOptimizeStreamingLatency = \ElevenLabs\Types\TtsOptimizeStreamingLatency::Zero->value;

    $supportedVoice = new \ElevenLabs\Types\SupportedVoice([
      'label' => 'label',
      'voiceId' => 'voice_id',
      'description' => 'description',
      'language' => 'language',
      'modelFamily' => $ttsModelFamily,
      'optimizeStreamingLatency' => $ttsOptimizeStreamingLatency,
      'stability' => 0.42,
      'speed' => 0.78,
      'similarityBoost' => 0.33,
      'cloneStrength' => 0.41
    ]);

    $suggestedAudioTag = new \ElevenLabs\Types\SuggestedAudioTag([
      'tag' => 'tag',
      'description' => 'description'
    ]);

    $ttsOutputFormat = \ElevenLabs\Types\TtsOutputFormat::Pcm8000->value;

    $ttsOptimizeStreamingLatency = \ElevenLabs\Types\TtsOptimizeStreamingLatency::Zero->value;

    $textNormalisationType = \ElevenLabs\Types\TextNormalisationType::SystemPrompt->value;

    $pydanticPronunciationDictionaryVersionLocator = new \ElevenLabs\Types\PydanticPronunciationDictionaryVersionLocator(
      [
        'pronunciationDictionaryId' => 'pronunciation_dictionary_id',
        'versionId' => 'version_id'
      ]
    );

    $effectsSpecOutput = new \ElevenLabs\Types\EffectsSpecOutput([
      'filterPresetId' => 'filter_preset_id',
      'distance' => 0.38,
      'environmentId' => 'environment_id',
      'backgroundNoiseId' => 'background_noise_id',
      'sendLevel' => 1,
      'pan' => -0.59
    ]);

    $ttsConversationalConfigOutput = new \ElevenLabs\Types\TtsConversationalConfigOutput([
      'modelId' => $ttsConversationalModel,
      'voiceId' => 'cjVigY5qzO86Huf0OWal',
      'supportedVoices' => [],
      'expressiveMode' => true,
      'suggestedAudioTags' => [],
      'agentOutputAudioFormat' => $ttsOutputFormat,
      'optimizeStreamingLatency' => $ttsOptimizeStreamingLatency,
      'stability' => 0.5,
      'speed' => 1,
      'similarityBoost' => 0.8,
      'cloneStrength' => 0.91,
      'textNormalisationType' => $textNormalisationType,
      'pronunciationDictionaryLocators' => [],
      'enablePhonemeTags' => true,
      'audioEffects' => $effectsSpecOutput
    ]);

    $clientEvent = \ElevenLabs\Types\ClientEvent::ConversationInitiationMetadata->value;

    $fileInputConfig = new \ElevenLabs\Types\FileInputConfig([
      'enabled' => true,
      'maxFilesInMemory' => 10,
      'maxFilesPerConversation' => 10
    ]);

    $dtmfInputConfig = new \ElevenLabs\Types\DtmfInputConfig([
      'dtmfInputTimeout' => 2,
      'hashTerminator' => true,
      'redactInput' => false
    ]);

    $backgroundSoundSourceType = \ElevenLabs\Types\BackgroundSoundSourceType::Preset->value;

    $backgroundSoundPresetId = \ElevenLabs\Types\BackgroundSoundPresetId::Office2->value;

    $backgroundSoundConfig = new \ElevenLabs\Types\BackgroundSoundConfig([
      'sourceType' => $backgroundSoundSourceType,
      'sourceId' => $backgroundSoundPresetId,
      'volume' => 0.15,
      'crossfadeLoop' => true
    ]);

    $conversationConfigOutput = new \ElevenLabs\Types\ConversationConfigOutput([
      'textOnly' => false,
      'maxDurationSeconds' => 600,
      'clientEvents' => [],
      'fileInput' => $fileInputConfig,
      'monitoringEnabled' => true,
      'monitoringEvents' => [],
      'dtmfInputSettings' => $dtmfInputConfig,
      'backgroundSound' => $backgroundSoundConfig,
      'sourceAttribution' => false
    ]);

    $asrConversationalConfigOverride = new \ElevenLabs\Types\AsrConversationalConfigOverride([
      'keywords' => []
    ]);

    $softTimeoutConfigOverride = new \ElevenLabs\Types\SoftTimeoutConfigOverride([
      'message' => 'message',
      'additionalSoftTimeoutMessages' => []
    ]);

    $turnConfigOverride = new \ElevenLabs\Types\TurnConfigOverride([
      'softTimeoutConfig' => $softTimeoutConfigOverride,
      'noisyEnvironmentMessage' => 'noisy_environment_message'
    ]);

    $ttsConversationalConfigOverride = new \ElevenLabs\Types\TtsConversationalConfigOverride([
      'modelId' => $ttsConversationalModel,
      'voiceId' => 'voice_id',
      'supportedVoices' => [],
      'stability' => 6.57,
      'speed' => 1.8,
      'similarityBoost' => 6.48,
      'cloneStrength' => 1.49,
      'pronunciationDictionaryLocators' => []
    ]);

    $conversationConfigOverride = new \ElevenLabs\Types\ConversationConfigOverride([
      'textOnly' => false,
      'maxDurationSeconds' => 5
    ]);

    $llm = \ElevenLabs\Types\Llm::Gpt4OMini->value;

    $llmReasoningEffort = \ElevenLabs\Types\LlmReasoningEffort::None->value;

    $knowledgeBaseDocumentType = \ElevenLabs\Types\KnowledgeBaseDocumentType::File->value;

    $documentUsageModeEnum = \ElevenLabs\Types\DocumentUsageModeEnum::Prompt->value;

    $knowledgeBaseLocator = new \ElevenLabs\Types\KnowledgeBaseLocator([
      'type' => $knowledgeBaseDocumentType,
      'name' => 'name',
      'id' => 'id',
      'usageMode' => $documentUsageModeEnum
    ]);

    $promptAgentApiModelOverrideOutput = new \ElevenLabs\Types\PromptAgentApiModelOverrideOutput([
      'prompt' => 'prompt',
      'llm' => $llm,
      'reasoningEffort' => $llmReasoningEffort,
      'toolIds' => [],
      'toolIdsStrict' => true,
      'nativeMcpServerIds' => [],
      'knowledgeBase' => []
    ]);

    $agentConfigOverrideOutput = new \ElevenLabs\Types\AgentConfigOverrideOutput([
      'firstMessage' => 'first_message',
      'language' => 'language',
      'maxConversationDurationMessage' => 'max_conversation_duration_message',
      'prompt' => $promptAgentApiModelOverrideOutput
    ]);

    $conversationConfigClientOverrideOutput = new \ElevenLabs\Types\ConversationConfigClientOverrideOutput(
      [
        'asr' => $asrConversationalConfigOverride,
        'turn' => $turnConfigOverride,
        'tts' => $ttsConversationalConfigOverride,
        'conversation' => $conversationConfigOverride,
        'agent' => $agentConfigOverrideOutput
      ]
    );

    $languagePresetTranslation = new \ElevenLabs\Types\LanguagePresetTranslation([
      'sourceHash' => 'source_hash',
      'text' => 'text'
    ]);

    $languagePresetOutput = new \ElevenLabs\Types\LanguagePresetOutput([
      'overrides' => $conversationConfigClientOverrideOutput,
      'firstMessageTranslation' => $languagePresetTranslation,
      'softTimeoutTranslation' => $languagePresetTranslation,
      'noisyEnvironmentMessageTranslation' => $languagePresetTranslation
    ]);

    $vadConfig = new \ElevenLabs\Types\VadConfig();

    $verbosity = \ElevenLabs\Types\Verbosity::Auto->value;

    $outputFormat = \ElevenLabs\Types\OutputFormat::Mp32205032->value;

    $interactionBudget = \ElevenLabs\Types\InteractionBudget::Realtime->value;

    $behaviorOverride = new \ElevenLabs\Types\BehaviorOverride([
      'verbosity' => $verbosity,
      'outputFormat' => $outputFormat,
      'interactionBudget' => $interactionBudget
    ]);

    $subAgentOutputExecutionMode = \ElevenLabs\Types\SubAgentOutputExecutionMode::Immediate->value;

    $objectJsonSchemaPropertyOutputType =
      \ElevenLabs\Types\ObjectJsonSchemaPropertyOutputType::Object->value;

    $literalJsonSchemaPropertyType = \ElevenLabs\Types\Type11::Boolean->value;

    $allowedValues = new \ElevenLabs\Types\AllowedValues([
      'dynamicVariable' => 'dynamic_variable'
    ]);

    $literalJsonSchemaPropertyConstantValue = 'veniam';

    $objectJsonSchemaPropertyOutputPropertiesValue = new \ElevenLabs\Types\LiteralJsonSchemaProperty(
      [
        'type' => $literalJsonSchemaPropertyType,
        'description' => 'description',
        'enum' => [],
        'isSystemProvided' => false,
        'dynamicVariable' => 'dynamic_variable',
        'allowedValues' => $allowedValues,
        'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
        'constantValue' => $literalJsonSchemaPropertyConstantValue,
        'isOmitted' => false
      ]
    );

    $requiredConstraint = new \ElevenLabs\Types\RequiredConstraint([
      'required' => []
    ]);

    $requiredConstraints = new \ElevenLabs\Types\RequiredConstraints([
      'anyOf' => [],
      'allOf' => []
    ]);

    $objectJsonSchemaPropertyOutput = new \ElevenLabs\Types\ObjectJsonSchemaPropertyOutput([
      'description' => 'description',
      'dynamicVariable' => 'dynamic_variable',
      'constantValue' => [],
      'isOmitted' => false,
      'type' => $objectJsonSchemaPropertyOutputType,
      'required' => [],
      'properties' => [],
      'requiredConstraints' => $requiredConstraints
    ]);

    $subAgentOutput = new \ElevenLabs\Types\SubAgentOutput([
      'executionMode' => $subAgentOutputExecutionMode,
      'timeoutSecs' => 60,
      'agentId' => 'agent_id',
      'branchId' => 'branch_id',
      'description' => 'description',
      'parameters' => $objectJsonSchemaPropertyOutput
    ]);

    $selfSubagentExecutionMode = \ElevenLabs\Types\SelfSubagentExecutionMode::Immediate->value;

    $selfSubagent = new \ElevenLabs\Types\SelfSubagent([
      'executionMode' => $selfSubagentExecutionMode,
      'timeoutSecs' => 60,
      'description' => 'description'
    ]);

    $subagentConfigOutput = new \ElevenLabs\Types\SubagentConfigOutput([
      'agents' => [],
      'selfSubagent' => $selfSubagent
    ]);

    $llmServiceTier = \ElevenLabs\Types\LlmServiceTier::Standard->value;

    $systemToolConfigOutputType = \ElevenLabs\Types\SystemToolConfigOutputType::System->value;

    $toolInterruptionMode = \ElevenLabs\Types\ToolInterruptionMode::Allow->value;

    $preToolSpeechMode = \ElevenLabs\Types\PreToolSpeechMode::Auto->value;

    $dynamicVariableAssignmentSource =
      \ElevenLabs\Types\DynamicVariableAssignmentSource::Response->value;

    $dynamicVariableAssignment = new \ElevenLabs\Types\DynamicVariableAssignment([
      'source' => $dynamicVariableAssignmentSource,
      'dynamicVariable' => 'dynamic_variable',
      'valuePath' => 'value_path',
      'sanitize' => false,
      'preserveNativeType' => false
    ]);

    $toolCallSoundType = \ElevenLabs\Types\ToolCallSoundType::Typing->value;

    $toolCallSoundBehavior = \ElevenLabs\Types\ToolCallSoundBehavior::Auto->value;

    $toolErrorHandlingMode = \ElevenLabs\Types\ToolErrorHandlingMode::Auto->value;

    $endCallToolConfigSystemToolType =
      \ElevenLabs\Types\EndCallToolConfigSystemToolType::EndCall->value;

    $endCallToolConfig = new \ElevenLabs\Types\EndCallToolConfig([
      'systemToolType' => $endCallToolConfigSystemToolType
    ]);
    $systemToolConfigOutputParams = \ElevenLabs\Types\SystemToolConfigOutputParams::endCall(
      $endCallToolConfig
    );

    $systemToolConfigOutput = new \ElevenLabs\Types\SystemToolConfigOutput([
      'type' => $systemToolConfigOutputType,
      'name' => 'name',
      'description' => 'description',
      'responseTimeoutSecs' => 20,
      'disableInterruptions' => true,
      'interruptionMode' => $toolInterruptionMode,
      'forcePreToolSpeech' => true,
      'preToolSpeech' => $preToolSpeechMode,
      'assignments' => [],
      'toolCallSound' => $toolCallSoundType,
      'toolCallSoundBehavior' => $toolCallSoundBehavior,
      'toolErrorHandlingMode' => $toolErrorHandlingMode,
      'params' => $systemToolConfigOutputParams
    ]);

    $builtInToolsOutput = new \ElevenLabs\Types\BuiltInToolsOutput([
      'transferToAgent' => $systemToolConfigOutput,
      'endCall' => $systemToolConfigOutput,
      'languageDetection' => $systemToolConfigOutput,
      'transferToNumber' => $systemToolConfigOutput,
      'skipTurn' => $systemToolConfigOutput,
      'playKeypadTouchTone' => $systemToolConfigOutput,
      'voicemailDetection' => $systemToolConfigOutput
    ]);

    $customLlmApiKey = new \ElevenLabs\Types\ConvAiSecretLocator([
      'secretId' => 'secret_id'
    ]);

    $customLlmAuthConnection = new \ElevenLabs\Types\AuthConnectionLocator([
      'authConnectionId' => 'auth_connection_id'
    ]);

    $customLlmRequestHeadersValue = new \ElevenLabs\Types\ConvAiSecretLocator([
      'secretId' => 'secret_id'
    ]);

    $customLlmapiType = \ElevenLabs\Types\CustomLlmapiType::ChatCompletions->value;

    $customLlm = new \ElevenLabs\Types\CustomLlm([
      'url' => 'url',
      'modelId' => 'model_id',
      'apiKey' => $customLlmApiKey,
      'authConnection' => $customLlmAuthConnection,
      'requestHeaders' => [],
      'apiVersion' => 'api_version',
      'apiType' => $customLlmapiType
    ]);

    $embeddingModelEnum = \ElevenLabs\Types\EmbeddingModelEnum::E5Mistral7BInstruct->value;

    $searchStrategy = \ElevenLabs\Types\SearchStrategy::Cat->value;

    $knowledgeBaseToolInfo = new \ElevenLabs\Types\KnowledgeBaseToolInfo([
      'enabledStrategies' => []
    ]);

    $ragConfigOutput = new \ElevenLabs\Types\RagConfigOutput([
      'enabled' => true,
      'embeddingModel' => $embeddingModelEnum,
      'maxVectorDistance' => 0.5,
      'maxDocumentsLength' => 50000,
      'maxRetrievedRagChunksCount' => 5,
      'numCandidates' => 8647,
      'queryRewritePromptOverride' => 'query_rewrite_prompt_override',
      'knowledgeBaseToolInfo' => $knowledgeBaseToolInfo
    ]);

    $backupLlmDefaultPreference = \ElevenLabs\Types\BackupLlmDefaultPreference::Default_->value;

    $backupLlmDefault = new \ElevenLabs\Types\BackupLlmDefault([
      'preference' => $backupLlmDefaultPreference
    ]);
    $promptAgentApiModelOutputBackupLlmConfig = \ElevenLabs\Types\PromptAgentApiModelOutputBackupLlmConfig::default(
      $backupLlmDefault
    );

    $webhookToolConfigOutputType = \ElevenLabs\Types\WebhookToolConfigOutputType::Webhook->value;

    $dynamicVariablesConfig = new \ElevenLabs\Types\DynamicVariablesConfig([
      'dynamicVariablePlaceholders' => []
    ]);

    $toolExecutionMode = \ElevenLabs\Types\ToolExecutionMode::Immediate->value;

    $webhookToolApiSchemaConfigOutputRequestHeadersValue = new \ElevenLabs\Types\ConvAiSecretLocator(
      [
        'secretId' => 'secret_id'
      ]
    );

    $webhookToolApiSchemaConfigOutputMethod =
      \ElevenLabs\Types\WebhookToolApiSchemaConfigOutputMethod::Get->value;

    $literalJsonSchemaProperty = new \ElevenLabs\Types\LiteralJsonSchemaProperty([
      'type' => $literalJsonSchemaPropertyType,
      'description' => 'description',
      'enum' => [],
      'isSystemProvided' => false,
      'dynamicVariable' => 'dynamic_variable',
      'allowedValues' => $allowedValues,
      'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
      'constantValue' => $literalJsonSchemaPropertyConstantValue,
      'isOmitted' => false
    ]);

    $queryParamsJsonSchemaOutputPropertiesValue = new \ElevenLabs\Types\LiteralJsonSchemaProperty([
      'type' => $literalJsonSchemaPropertyType,
      'description' => 'description',
      'enum' => [],
      'isSystemProvided' => false,
      'dynamicVariable' => 'dynamic_variable',
      'allowedValues' => $allowedValues,
      'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
      'constantValue' => $literalJsonSchemaPropertyConstantValue,
      'isOmitted' => false
    ]);

    $queryParamsJsonSchemaOutput = new \ElevenLabs\Types\QueryParamsJsonSchemaOutput([
      'properties' => [],
      'required' => []
    ]);

    $responseFilterMode = \ElevenLabs\Types\ResponseFilterMode::All->value;

    $responseFilterContentType =
      \ElevenLabs\Types\ResponseFilterContentType::ApplicationJson->value;

    $responseFilter = new \ElevenLabs\Types\ResponseFilter([
      'mode' => $responseFilterMode,
      'filters' => [],
      'contentType' => $responseFilterContentType
    ]);

    $webhookToolApiSchemaConfigOutputContentType =
      \ElevenLabs\Types\WebhookToolApiSchemaConfigOutputContentType::ApplicationJson->value;

    $webhookToolApiSchemaConfigOutputAuthConnection = new \ElevenLabs\Types\AuthConnectionLocator([
      'authConnectionId' => 'auth_connection_id'
    ]);

    $webhookToolApiSchemaConfigOutput = new \ElevenLabs\Types\WebhookToolApiSchemaConfigOutput([
      'requestHeaders' => [],
      'url' => 'url',
      'method' => $webhookToolApiSchemaConfigOutputMethod,
      'pathParamsSchema' => [],
      'queryParamsSchema' => $queryParamsJsonSchemaOutput,
      'requestBodySchema' => $objectJsonSchemaPropertyOutput,
      'responseBodySchema' => $objectJsonSchemaPropertyOutput,
      'responseFilter' => $responseFilter,
      'contentType' => $webhookToolApiSchemaConfigOutputContentType,
      'authResolvedParams' => [],
      'authConnection' => $webhookToolApiSchemaConfigOutputAuthConnection
    ]);

    $webhookToolConfigOutput = new \ElevenLabs\Types\WebhookToolConfigOutput([
      'type' => $webhookToolConfigOutputType,
      'name' => 'name',
      'description' => 'description',
      'responseTimeoutSecs' => 20,
      'disableInterruptions' => true,
      'interruptionMode' => $toolInterruptionMode,
      'forcePreToolSpeech' => true,
      'preToolSpeech' => $preToolSpeechMode,
      'assignments' => [],
      'toolCallSound' => $toolCallSoundType,
      'toolCallSoundBehavior' => $toolCallSoundBehavior,
      'toolErrorHandlingMode' => $toolErrorHandlingMode,
      'dynamicVariables' => $dynamicVariablesConfig,
      'executionMode' => $toolExecutionMode,
      'apiSchema' => $webhookToolApiSchemaConfigOutput,
      'followRedirects' => true,
      'followRedirectsAllowedDomains' => []
    ]);
    $promptAgentApiModelOutputToolsItem = \ElevenLabs\Types\PromptAgentApiModelOutputToolsItem::webhook(
      $webhookToolConfigOutput
    );

    $promptAgentApiModelOutput = new \ElevenLabs\Types\PromptAgentApiModelOutput([
      'prompt' => 'prompt',
      'llm' => $llm,
      'reasoningEffort' => $llmReasoningEffort,
      'serviceTier' => $llmServiceTier,
      'thinkingBudget' => 3,
      'enableReasoningSummary' => true,
      'temperature' => 6.3,
      'maxTokens' => -1,
      'toolIds' => [],
      'toolIdsStrict' => false,
      'builtInTools' => $builtInToolsOutput,
      'enableParallelToolCalls' => true,
      'mcpServerIds' => [],
      'nativeMcpServerIds' => [],
      'knowledgeBase' => [],
      'customLlm' => $customLlm,
      'ignoreDefaultPersonality' => true,
      'rag' => $ragConfigOutput,
      'timezone' => 'timezone',
      'backupLlmConfig' => $promptAgentApiModelOutputBackupLlmConfig,
      'cascadeTimeoutSeconds' => 4,
      'tools' => []
    ]);

    $agentConfig = new \ElevenLabs\Types\AgentConfig([
      'firstMessage' => 'first_message',
      'language' => 'en',
      'hinglishMode' => false,
      'dynamicVariables' => [],
      'disableFirstMessageInterruptions' => false,
      'maxConversationDurationMessage' => 'max_conversation_duration_message',
      'textBehaviorOverrides' => [],
      'subagentConfig' => $subagentConfigOutput,
      'prompt' => $promptAgentApiModelOutput
    ]);

    $conversationalConfig = new \ElevenLabs\Types\ConversationalConfig([
      'asr' => $asrConversationalConfig,
      'turn' => $turnConfig,
      'tts' => $ttsConversationalConfigOutput,
      'conversation' => $conversationConfigOutput,
      'languagePresets' => [],
      'vad' => $vadConfig,
      'agent' => $agentConfig
    ]);

    $promptEvaluationCriteriaType = \ElevenLabs\Types\PromptEvaluationCriteriaType::Prompt->value;

    $analysisScope = \ElevenLabs\Types\AnalysisScope::Conversation->value;

    $criteriaScoringMode = \ElevenLabs\Types\CriteriaScoringMode::Binary->value;

    $promptEvaluationCriteria = new \ElevenLabs\Types\PromptEvaluationCriteria([
      'id' => 'id',
      'name' => 'name',
      'type' => $promptEvaluationCriteriaType,
      'conversationGoalPrompt' => 'conversation_goal_prompt',
      'useKnowledgeBase' => false,
      'scope' => $analysisScope,
      'llm' => $llm,
      'scoringMode' => $criteriaScoringMode,
      'maxScore' => 100,
      'scoreInstructions' => 'score_instructions'
    ]);

    $evaluationSettingsInput = new \ElevenLabs\Types\EvaluationSettingsInput([
      'criteria' => []
    ]);

    $embedVariant = \ElevenLabs\Types\EmbedVariant::Tiny->value;

    $widgetPlacement = \ElevenLabs\Types\WidgetPlacement::TopLeft->value;

    $widgetExpandable = \ElevenLabs\Types\WidgetExpandable::Never->value;

    $orbAvatarType = \ElevenLabs\Types\OrbAvatarType::Orb->value;

    $orbAvatar = new \ElevenLabs\Types\OrbAvatar([
      'type' => $orbAvatarType,
      'color1' => '#2792dc',
      'color2' => '#9ce6e6'
    ]);
    $widgetConfigAvatar = \ElevenLabs\Types\WidgetConfigAvatar::orb($orbAvatar);

    $widgetFeedbackMode = \ElevenLabs\Types\WidgetFeedbackMode::None->value;

    $widgetEndFeedbackType = \ElevenLabs\Types\WidgetEndFeedbackType::Rating->value;

    $widgetEndFeedbackConfig = new \ElevenLabs\Types\WidgetEndFeedbackConfig([
      'type' => $widgetEndFeedbackType
    ]);

    $allowlistItem = new \ElevenLabs\Types\AllowlistItem([
      'hostname' => 'hostname'
    ]);

    $widgetConfigSyntaxHighlightTheme =
      \ElevenLabs\Types\WidgetConfigSyntaxHighlightTheme::Light->value;

    $widgetTextContents = new \ElevenLabs\Types\WidgetTextContents([
      'mainLabel' => 'main_label',
      'startCall' => 'start_call',
      'startChat' => 'start_chat',
      'newCall' => 'new_call',
      'endCall' => 'end_call',
      'muteMicrophone' => 'mute_microphone',
      'changeLanguage' => 'change_language',
      'collapse' => 'collapse',
      'expand' => 'expand',
      'copied' => 'copied',
      'acceptTerms' => 'accept_terms',
      'dismissTerms' => 'dismiss_terms',
      'listeningStatus' => 'listening_status',
      'speakingStatus' => 'speaking_status',
      'connectingStatus' => 'connecting_status',
      'chattingStatus' => 'chatting_status',
      'queueWaitingStatus' => 'queue_waiting_status',
      'queueWaitingStatusShort' => 'queue_waiting_status_short',
      'inputLabel' => 'input_label',
      'inputPlaceholder' => 'input_placeholder',
      'inputPlaceholderTextOnly' => 'input_placeholder_text_only',
      'inputPlaceholderNewConversation' => 'input_placeholder_new_conversation',
      'userEndedConversation' => 'user_ended_conversation',
      'agentEndedConversation' => 'agent_ended_conversation',
      'conversationId' => 'conversation_id',
      'errorOccurred' => 'error_occurred',
      'queueTimedOut' => 'queue_timed_out',
      'copyId' => 'copy_id',
      'initiateFeedback' => 'initiate_feedback',
      'requestFollowUpFeedback' => 'request_follow_up_feedback',
      'thanksForFeedback' => 'thanks_for_feedback',
      'thanksForFeedbackDetails' => 'thanks_for_feedback_details',
      'followUpFeedbackPlaceholder' => 'follow_up_feedback_placeholder',
      'submit' => 'submit',
      'goBack' => 'go_back',
      'sendMessage' => 'send_message',
      'textMode' => 'text_mode',
      'voiceMode' => 'voice_mode',
      'switchedToTextMode' => 'switched_to_text_mode',
      'switchedToVoiceMode' => 'switched_to_voice_mode',
      'copy' => 'copy',
      'download' => 'download',
      'wrap' => 'wrap',
      'agentWorking' => 'agent_working',
      'agentDone' => 'agent_done',
      'agentError' => 'agent_error',
      'attachFile' => 'attach_file',
      'removeFile' => 'remove_file',
      'fileUploadError' => 'file_upload_error',
      'fileTypeUnsupported' => 'file_type_unsupported',
      'fileTooLarge' => 'file_too_large',
      'fileLimitReached' => 'file_limit_reached',
      'typingIndicator' => 'typing_indicator',
      'richContentUnavailable' => 'rich_content_unavailable'
    ]);

    $widgetStyles = new \ElevenLabs\Types\WidgetStyles([
      'base' => 'base',
      'baseHover' => 'base_hover',
      'baseActive' => 'base_active',
      'baseBorder' => 'base_border',
      'baseSubtle' => 'base_subtle',
      'basePrimary' => 'base_primary',
      'baseError' => 'base_error',
      'accent' => 'accent',
      'accentHover' => 'accent_hover',
      'accentActive' => 'accent_active',
      'accentBorder' => 'accent_border',
      'accentSubtle' => 'accent_subtle',
      'accentPrimary' => 'accent_primary',
      'overlayPadding' => 6.64,
      'buttonRadius' => 6.41,
      'inputRadius' => 6.32,
      'bubbleRadius' => 3.68,
      'sheetRadius' => 3.55,
      'compactSheetRadius' => 3.52,
      'dropdownSheetRadius' => 6.58
    ]);

    $widgetTextContentsTranslation = new \ElevenLabs\Types\WidgetTextContentsTranslation([
      'source' => [],
      'text' => []
    ]);

    $widgetTermsTranslation = new \ElevenLabs\Types\WidgetTermsTranslation([
      'sourceHash' => 'source_hash',
      'text' => 'text'
    ]);

    $widgetLanguagePreset = new \ElevenLabs\Types\WidgetLanguagePreset([
      'textContents' => $widgetTextContents,
      'textContentsTranslation' => $widgetTextContentsTranslation,
      'termsText' => 'terms_text',
      'termsHtml' => 'terms_html',
      'termsKey' => 'terms_key',
      'termsTranslation' => $widgetTermsTranslation
    ]);

    $widgetConfig = new \ElevenLabs\Types\WidgetConfig([
      'variant' => $embedVariant,
      'placement' => $widgetPlacement,
      'expandable' => $widgetExpandable,
      'avatar' => $widgetConfigAvatar,
      'feedbackMode' => $widgetFeedbackMode,
      'endFeedback' => $widgetEndFeedbackConfig,
      'bgColor' => '#ffffff',
      'textColor' => '#000000',
      'btnColor' => '#000000',
      'btnTextColor' => '#ffffff',
      'borderColor' => '#e1e1e1',
      'focusColor' => '#000000',
      'borderRadius' => 5,
      'btnRadius' => 8,
      'actionText' => 'action_text',
      'startCallText' => 'start_call_text',
      'endCallText' => 'end_call_text',
      'expandText' => 'expand_text',
      'listeningText' => 'listening_text',
      'speakingText' => 'speaking_text',
      'shareablePageText' => 'shareable_page_text',
      'shareablePageShowTerms' => true,
      'termsText' => 'terms_text',
      'termsHtml' => 'terms_html',
      'termsKey' => 'terms_key',
      'showAvatarWhenCollapsed' => true,
      'disableBanner' => true,
      'overrideLink' => 'override_link',
      'markdownLinkAllowedHosts' => [],
      'markdownLinkIncludeWww' => true,
      'markdownLinkAllowHttp' => true,
      'micMutingEnabled' => true,
      'transcriptEnabled' => true,
      'textInputEnabled' => true,
      'conversationModeToggleEnabled' => true,
      'defaultExpanded' => false,
      'alwaysExpanded' => true,
      'dismissible' => false,
      'showAgentStatus' => false,
      'showConversationId' => true,
      'stripAudioTags' => true,
      'syntaxHighlightTheme' => $widgetConfigSyntaxHighlightTheme,
      'textContents' => $widgetTextContents,
      'styles' => $widgetStyles,
      'showResizeButton' => true,
      'endConfirmationEnabled' => false,
      'mobileFullscreen' => true,
      'transcriptSpeechSyncEnabled' => true,
      'languageSelector' => false,
      'supportsTextOnly' => true,
      'customAvatarPath' => 'custom_avatar_path',
      'languagePresets' => []
    ]);

    $analysisPropertyType = \ElevenLabs\Types\AnalysisPropertyType::Boolean->value;

    $analysisPropertyConstantValue = 'irure dese';

    $analysisProperty = new \ElevenLabs\Types\AnalysisProperty([
      'type' => $analysisPropertyType,
      'description' => 'description',
      'enum' => [],
      'isSystemProvided' => true,
      'dynamicVariable' => 'dynamic_variable',
      'allowedValues' => $allowedValues,
      'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
      'constantValue' => $analysisPropertyConstantValue,
      'isOmitted' => false,
      'name' => 'name',
      'llm' => $llm
    ]);

    $analysisScope = \ElevenLabs\Types\AnalysisScope::Conversation->value;

    $attachedUserEvaluationRefSource =
      \ElevenLabs\Types\AttachedUserEvaluationRefSource::User->value;

    $attachedUserEvaluationRef = new \ElevenLabs\Types\AttachedUserEvaluationRef([
      'source' => $attachedUserEvaluationRefSource,
      'analysisItemId' => 'analysis_item_id',
      'versionId' => 'latest',
      'additionalVersionIds' => [],
      'scope' => $analysisScope,
      'weight' => 7.08
    ]);
    $agentAnalysisItemsInputEvaluationCriteriaItem = \ElevenLabs\Types\AgentAnalysisItemsInputEvaluationCriteriaItem::user(
      $attachedUserEvaluationRef
    );

    $attachedUserDataCollectionRefSource =
      \ElevenLabs\Types\AttachedUserDataCollectionRefSource::User->value;

    $attachedUserDataCollectionRef = new \ElevenLabs\Types\AttachedUserDataCollectionRef([
      'source' => $attachedUserDataCollectionRefSource,
      'analysisItemId' => 'analysis_item_id',
      'versionId' => 'latest',
      'scope' => $analysisScope
    ]);
    $agentAnalysisItemsInputDataCollectionItem = \ElevenLabs\Types\AgentAnalysisItemsInputDataCollectionItem::user(
      $attachedUserDataCollectionRef
    );

    $agentAnalysisItemsInput = new \ElevenLabs\Types\AgentAnalysisItemsInput([
      'evaluationCriteria' => [],
      'dataCollection' => []
    ]);

    $asrConversationalConfigOverrideConfig = new \ElevenLabs\Types\AsrConversationalConfigOverrideConfig(
      [
        'keywords' => false
      ]
    );

    $softTimeoutConfigOverrideConfig = new \ElevenLabs\Types\SoftTimeoutConfigOverrideConfig([
      'message' => false,
      'additionalSoftTimeoutMessages' => false
    ]);

    $turnConfigOverrideConfig = new \ElevenLabs\Types\TurnConfigOverrideConfig([
      'softTimeoutConfig' => $softTimeoutConfigOverrideConfig,
      'noisyEnvironmentMessage' => false
    ]);

    $ttsConversationalConfigOverrideConfig = new \ElevenLabs\Types\TtsConversationalConfigOverrideConfig(
      [
        'modelId' => false,
        'voiceId' => false,
        'supportedVoices' => false,
        'stability' => false,
        'speed' => false,
        'similarityBoost' => true,
        'cloneStrength' => true,
        'pronunciationDictionaryLocators' => false
      ]
    );

    $conversationConfigOverrideConfig = new \ElevenLabs\Types\ConversationConfigOverrideConfig([
      'textOnly' => true,
      'maxDurationSeconds' => false
    ]);

    $promptAgentApiModelOverrideConfig = new \ElevenLabs\Types\PromptAgentApiModelOverrideConfig([
      'prompt' => true,
      'llm' => false,
      'reasoningEffort' => false,
      'toolIds' => true,
      'toolIdsStrict' => true,
      'nativeMcpServerIds' => true,
      'knowledgeBase' => true
    ]);

    $agentConfigOverrideConfig = new \ElevenLabs\Types\AgentConfigOverrideConfig([
      'firstMessage' => true,
      'language' => true,
      'maxConversationDurationMessage' => true,
      'prompt' => $promptAgentApiModelOverrideConfig
    ]);

    $conversationConfigClientOverrideConfigInput = new \ElevenLabs\Types\ConversationConfigClientOverrideConfigInput(
      [
        'asr' => $asrConversationalConfigOverrideConfig,
        'turn' => $turnConfigOverrideConfig,
        'tts' => $ttsConversationalConfigOverrideConfig,
        'conversation' => $conversationConfigOverrideConfig,
        'agent' => $agentConfigOverrideConfig
      ]
    );

    $conversationInitiationClientDataConfigInput = new \ElevenLabs\Types\ConversationInitiationClientDataConfigInput(
      [
        'conversationConfigOverride' => $conversationConfigClientOverrideConfigInput,
        'customLlmExtraBody' => true,
        'enableConversationInitiationClientDataFromWebhook' => false,
        'enableStartingWorkflowNodeIdFromClient' => true,
        'enableProcedureIdsFromClient' => false
      ]
    );

    $conversationInitiationClientDataWebhookRequestHeadersValue = new \ElevenLabs\Types\ConvAiSecretLocator(
      [
        'secretId' => 'secret_id'
      ]
    );

    $conversationInitiationClientDataWebhook = new \ElevenLabs\Types\ConversationInitiationClientDataWebhook(
      [
        'url' => 'url',
        'requestHeaders' => []
      ]
    );

    $webhookEventType = \ElevenLabs\Types\WebhookEventType::Transcript->value;

    $webhookTranscriptFormat = \ElevenLabs\Types\WebhookTranscriptFormat::Json->value;

    $convAiWebhooks = new \ElevenLabs\Types\ConvAiWebhooks([
      'postCallWebhookId' => 'post_call_webhook_id',
      'events' => [],
      'transcriptFormat' => $webhookTranscriptFormat,
      'excludeTranscript' => false,
      'sendAudio' => true
    ]);

    $agentWorkspaceOverridesInput = new \ElevenLabs\Types\AgentWorkspaceOverridesInput([
      'conversationInitiationClientDataWebhook' => $conversationInitiationClientDataWebhook,
      'webhooks' => $convAiWebhooks
    ]);

    $attachedTestModel = new \ElevenLabs\Types\AttachedTestModel([
      'testId' => 'test_id',
      'workflowNodeId' => 'workflow_node_id'
    ]);

    $agentTestingSettings = new \ElevenLabs\Types\AgentTestingSettings([
      'attachedTests' => []
    ]);

    $guardrailsV1InputVersion = \ElevenLabs\Types\GuardrailsV1InputVersion::One->value;

    $focusGuardrail = new \ElevenLabs\Types\FocusGuardrail([
      'isEnabled' => false
    ]);

    $promptInjectionGuardrail = new \ElevenLabs\Types\PromptInjectionGuardrail([
      'isEnabled' => false
    ]);

    $guardrailExecutionMode = \ElevenLabs\Types\GuardrailExecutionMode::Streaming->value;

    $contentThresholdGuardrailThreshold = \ElevenLabs\Types\Threshold2::Low->value;

    $contentThresholdGuardrail = new \ElevenLabs\Types\ContentThresholdGuardrail([
      'isEnabled' => false,
      'threshold' => $contentThresholdGuardrailThreshold
    ]);

    $contentConfig = new \ElevenLabs\Types\ContentConfig([
      'sexual' => $contentThresholdGuardrail,
      'violence' => $contentThresholdGuardrail,
      'harassment' => $contentThresholdGuardrail,
      'selfHarm' => $contentThresholdGuardrail,
      'profanity' => $contentThresholdGuardrail,
      'religionOrPolitics' => $contentThresholdGuardrail,
      'medicalAndLegalInformation' => $contentThresholdGuardrail
    ]);

    $endCallTriggerActionType = \ElevenLabs\Types\EndCallTriggerActionType::EndCall->value;

    $endCallTriggerAction = new \ElevenLabs\Types\EndCallTriggerAction([
      'type' => $endCallTriggerActionType
    ]);
    $contentGuardrailInputTriggerAction = \ElevenLabs\Types\ContentGuardrailInputTriggerAction::endCall(
      $endCallTriggerAction
    );

    $contentGuardrailInput = new \ElevenLabs\Types\ContentGuardrailInput([
      'executionMode' => $guardrailExecutionMode,
      'config' => $contentConfig,
      'triggerAction' => $contentGuardrailInputTriggerAction
    ]);

    $customGuardrailConfigModel =
      \ElevenLabs\Types\CustomGuardrailConfigModel::Gemini25FlashLite->value;

    $customGuardrailConfigTriggerAction = \ElevenLabs\Types\CustomGuardrailConfigTriggerAction::endCall(
      $endCallTriggerAction
    );

    $customGuardrailConfig = new \ElevenLabs\Types\CustomGuardrailConfig([
      'isEnabled' => true,
      'name' => 'name',
      'prompt' => 'prompt',
      'executionMode' => $guardrailExecutionMode,
      'model' => $customGuardrailConfigModel,
      'serviceTier' => $llmServiceTier,
      'historyMessageCount' => 33,
      'triggerAction' => $customGuardrailConfigTriggerAction,
      'evaluateFullResponseOnly' => false
    ]);

    $customGuardrailsConfigInput = new \ElevenLabs\Types\CustomGuardrailsConfigInput([
      'configs' => []
    ]);

    $customGuardrailInput = new \ElevenLabs\Types\CustomGuardrailInput([
      'config' => $customGuardrailsConfigInput
    ]);

    $guardrailsV1Input = new \ElevenLabs\Types\GuardrailsV1Input([
      'version' => $guardrailsV1InputVersion,
      'focus' => $focusGuardrail,
      'promptInjection' => $promptInjectionGuardrail,
      'content' => $contentGuardrailInput,
      'custom' => $customGuardrailInput
    ]);

    $authSettings = new \ElevenLabs\Types\AuthSettings([
      'enableAuth' => true,
      'allowlist' => [],
      'requireOriginHeader' => true,
      'shareableToken' => 'shareable_token'
    ]);

    $agentCallLimits = new \ElevenLabs\Types\AgentCallLimits([
      'agentConcurrencyLimit' => -1,
      'dailyLimit' => 100000,
      'burstingEnabled' => true
    ]);

    $agentHoldAudioConfig = new \ElevenLabs\Types\AgentHoldAudioConfig([
      'audioPath' => 'audio_path',
      'audioUrl' => 'audio_url',
      'originalFilename' => 'original_filename',
      'durationSecs' => 4.56,
      'sizeBytes' => 7
    ]);

    $agentQueueingConfig = new \ElevenLabs\Types\AgentQueueingConfig([
      'enabled' => false,
      'waitTimeoutSeconds' => 180,
      'holdAudio' => $agentHoldAudioConfig
    ]);

    $configEntityType = \ElevenLabs\Types\ConfigEntityType::Name->value;

    $conversationHistoryRedactionConfig = new \ElevenLabs\Types\ConversationHistoryRedactionConfig([
      'enabled' => false,
      'entities' => [],
      'excludedDataCollectionIds' => []
    ]);

    $privacyConfigInput = new \ElevenLabs\Types\PrivacyConfigInput([
      'recordVoice' => true,
      'retentionDays' => -1,
      'deleteTranscriptAndPii' => true,
      'deleteAudio' => false,
      'applyToExistingConversations' => true,
      'zeroRetentionMode' => true,
      'conversationHistoryRedaction' => $conversationHistoryRedactionConfig
    ]);

    $agentTrustContext = \ElevenLabs\Types\AgentTrustContext::Unknown->value;

    $topicDiscoverySettings = new \ElevenLabs\Types\TopicDiscoverySettings();

    $sentimentAnalysisSettings = new \ElevenLabs\Types\SentimentAnalysisSettings();

    $alertingMonitorConfig = new \ElevenLabs\Types\AlertingMonitorConfig([
      'enabled' => false,
      'threshold' => 0.24,
      'relativeIncreaseThreshold' => 9.18,
      'minFailureCount' => 1,
      'minHistoryBucketCount' => 7,
      'minSampleCount' => 2,
      'suspectTriggerThreshold' => 8,
      'autoResolveAfterInactiveMinutes' => 10
    ]);

    $alertingWebhookNotifierType = \ElevenLabs\Types\AlertingWebhookNotifierType::Webhook->value;

    $alertingWebhookNotifier = new \ElevenLabs\Types\AlertingWebhookNotifier([
      'type' => $alertingWebhookNotifierType,
      'webhookId' => 'webhook_id'
    ]);
    $alertingSettingsNotifiersItem = \ElevenLabs\Types\AlertingSettingsNotifiersItem::webhook(
      $alertingWebhookNotifier
    );

    $alertingSettings = new \ElevenLabs\Types\AlertingSettings([
      'monitorConfigs' => [],
      'autoResolveAfterInactiveMinutes' => 10,
      'environments' => ['environments'],
      'notifiers' => []
    ]);

    $agentPlatformSettingsRequestModel = new \ElevenLabs\Types\AgentPlatformSettingsRequestModel([
      'evaluation' => $evaluationSettingsInput,
      'widget' => $widgetConfig,
      'dataCollection' => [],
      'dataCollectionScopes' => [],
      'analysisItems' => $agentAnalysisItemsInput,
      'overrides' => $conversationInitiationClientDataConfigInput,
      'workspaceOverrides' => $agentWorkspaceOverridesInput,
      'testing' => $agentTestingSettings,
      'archived' => false,
      'guardrails' => $guardrailsV1Input,
      'summaryLanguage' => 'summary_language',
      'autoTranslateTranscriptToAppLanguage' => false,
      'auth' => $authSettings,
      'callLimits' => $agentCallLimits,
      'queueingConfig' => $agentQueueingConfig,
      'privacy' => $privacyConfigInput,
      'trustContext' => $agentTrustContext,
      'analysisLlm' => $llm,
      'topicDiscovery' => $topicDiscoverySettings,
      'sentimentAnalysis' => $sentimentAnalysisSettings,
      'alerting' => $alertingSettings
    ]);

    $workflowUnconditionalModelInputType =
      \ElevenLabs\Types\WorkflowUnconditionalModelInputType::Unconditional->value;

    $workflowUnconditionalModelInput = new \ElevenLabs\Types\WorkflowUnconditionalModelInput([
      'label' => 'label',
      'type' => $workflowUnconditionalModelInputType
    ]);
    $workflowEdgeModelInputForwardCondition = \ElevenLabs\Types\WorkflowEdgeModelInputForwardCondition::unconditional(
      $workflowUnconditionalModelInput
    );

    $workflowEdgeModelInputBackwardCondition = \ElevenLabs\Types\WorkflowEdgeModelInputBackwardCondition::unconditional(
      $workflowUnconditionalModelInput
    );

    $positionInput = new \ElevenLabs\Types\PositionInput([
      'x' => 0.13,
      'y' => 8.06
    ]);

    $workflowEdgeModelInput = new \ElevenLabs\Types\WorkflowEdgeModelInput([
      'source' => 'source',
      'target' => 'target',
      'forwardCondition' => $workflowEdgeModelInputForwardCondition,
      'backwardCondition' => $workflowEdgeModelInputBackwardCondition,
      'reroutes' => []
    ]);

    $workflowStartNodeModelInputType =
      \ElevenLabs\Types\WorkflowStartNodeModelInputType::Start->value;

    $workflowStartNodeModelInput = new \ElevenLabs\Types\WorkflowStartNodeModelInput([
      'type' => $workflowStartNodeModelInputType,
      'position' => $positionInput,
      'edgeOrder' => []
    ]);
    $agentWorkflowRequestModelNodesValue = \ElevenLabs\Types\AgentWorkflowRequestModelNodesValue::start(
      $workflowStartNodeModelInput
    );

    $agentWorkflowRequestModel = new \ElevenLabs\Types\AgentWorkflowRequestModel([
      'edges' => [],
      'nodes' => [],
      'preventSubagentLoops' => false
    ]);

    $adhocAgentConfigOverrideForTestRequestModel = new \ElevenLabs\Types\AdhocAgentConfigOverrideForTestRequestModel(
      [
        'conversationConfig' => $conversationalConfig,
        'platformSettings' => $agentPlatformSettingsRequestModel,
        'workflow' => $agentWorkflowRequestModel
      ]
    );

    $request = new \ElevenLabs\Agents\Tests\Invocations\Requests\ResubmitTestsRequestModel([
      'testRunIds' => ['test_run_ids'],
      'agentConfigOverride' => $adhocAgentConfigOverrideForTestRequestModel,
      'agentId' => 'agent_id',
      'branchId' => 'branch_id'
    ]);
    $sdk->agents->tests->invocations->resubmit(
      request: $request,
      testInvocationId: 'test_invocation_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/test-invocations/[^/]+/resubmit$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  /**
   * @return ClientInterface&object{requests: list<RequestInterface>}
   */
  private function transport(int $status, string $body): ClientInterface
  {
    return new class ($status, $body) implements ClientInterface {
      /** @var list<RequestInterface> */
      public array $requests = [];

      public function __construct(private int $status, private string $body)
      {
      }

      public function sendRequest(RequestInterface $request): ResponseInterface
      {
        $this->requests[] = $request;

        return new \GuzzleHttp\Psr7\Response(
          $this->status,
          ['Content-Type' => 'application/json'],
          $this->body
        );
      }
    };
  }
}

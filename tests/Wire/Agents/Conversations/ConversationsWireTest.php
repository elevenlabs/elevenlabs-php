<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Conversations;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ConversationsWireTest extends TestCase
{
  public function testGetSignedUrlSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "signed_url": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->conversations->getSignedUrl(
      request: new \ElevenLabs\Agents\Conversations\Requests\GetSignedUrlConversationsRequest([
        'agentId' => 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
        'includeConversationId' => true,
        'branchId' => 'branch_id',
        'versionId' => 'version_id',
        'environment' => 'environment',
        'debugEventsRequest' => true
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/conversation/get-signed-url$#',
      rawurldecode($sent->getUri()->getPath())
    );
    parse_str($sent->getUri()->getQuery(), $query);
    $this->assertArrayHasKey('agent_id', $query);
  }

  public function testGetWebrtcTokenSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "token": "test-value",
          "conversation_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->conversations->getWebrtcToken(
      request: new \ElevenLabs\Agents\Conversations\Requests\GetWebrtcTokenConversationsRequest([
        'agentId' => 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
        'participantName' => 'participant_name',
        'branchId' => 'branch_id',
        'versionId' => 'version_id',
        'environment' => 'environment',
        'debugEventsRequest' => true
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/conversation/token$#',
      rawurldecode($sent->getUri()->getPath())
    );
    parse_str($sent->getUri()->getQuery(), $query);
    $this->assertArrayHasKey('agent_id', $query);
  }

  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "conversations": [
              {
                  "agent_id": "test-value",
                  "branch_id": "test-value",
                  "version_id": "test-value",
                  "agent_name": "test-value",
                  "conversation_id": "test-value",
                  "start_time_unix_secs": 1,
                  "call_duration_secs": 1,
                  "cost": 1,
                  "cost_fiat": 1,
                  "message_count": 1,
                  "user_message_count": 1,
                  "agent_message_count": 1,
                  "status": "initiated",
                  "termination_reason": "test-value",
                  "call_successful": "success",
                  "call_success_score": 1,
                  "transcript_summary": "test-value",
                  "call_summary_title": "test-value",
                  "main_language": "test-value",
                  "conversation_initiation_source": "unknown",
                  "tool_names": [
                      "test-value"
                  ],
                  "direction": "inbound",
                  "rating": 1,
                  "sentiment_analysis": {
                      "overall_label": "positive",
                      "overall_sentiment_score": -1,
                      "overall_frustration_score": 0,
                      "min_user_sentiment_score": -1,
                      "max_user_frustration_score": 0,
                      "num_scored_user_turns": 0
                  },
                  "data_collection_results": {
                      "key": "test-value"
                  },
                  "evaluation_criteria_results": {
                      "key": {
                          "result": "success",
                          "score": 1,
                          "max_score": 1
                      }
                  },
                  "tag_ids": [
                      "test-value"
                  ]
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $callSuccessful = \ElevenLabs\Types\EvaluationResultFilter::Success;
    $summaryMode =
      \ElevenLabs\Agents\Conversations\Types\ListConversationsRequestSummaryMode::Exclude;
    $conversationInitiationSource = \ElevenLabs\Types\ConversationInitiationSource::Unknown;
    $conversationProductType = \ElevenLabs\Types\ConversationProduct::Agents;
    $sortDirection = \ElevenLabs\Types\SortDirection::Asc;
    $sdk->agents->conversations->list(
      request: new \ElevenLabs\Agents\Conversations\Requests\ListConversationsRequest([
        'cursor' => 'cursor',
        'agentId' => 'agent_id',
        'visitedAgentIds' => [],
        'visitedAgentBranchIds' => [],
        'triggeredProcedureIds' => [],
        'callSuccessful' => $callSuccessful->value,
        'callStartBeforeUnix' => 9,
        'callStartAfterUnix' => 10,
        'callDurationMinSecs' => 5,
        'callDurationMaxSecs' => 5,
        'ratingMax' => 5,
        'ratingMin' => 1,
        'hasFeedbackComment' => false,
        'userId' => 'user_id',
        'evaluationParams' => [],
        'dataCollectionParams' => [],
        'dynamicVariableParams' => [],
        'dataCollectionFilter' => 'data_collection_filter',
        'dynamicVariableFilter' => 'dynamic_variable_filter',
        'dataCollectionIds' => [],
        'evaluationCriteriaIds' => [],
        'toolNames' => [],
        'toolNamesSuccessful' => [],
        'toolNamesErrored' => [],
        'toolIds' => [],
        'toolIdsSuccessful' => [],
        'toolIdsErrored' => [],
        'includeInvalidToolCalls' => true,
        'mainLanguages' => [],
        'phoneNumberIds' => [],
        'whatsappPhoneNumberIds' => [],
        'pageSize' => 30,
        'summaryMode' => $summaryMode->value,
        'search' => 'search',
        'conversationInitiationSource' => $conversationInitiationSource->value,
        'textOnly' => true,
        'conversationProductType' => $conversationProductType->value,
        'branchId' => 'branch_id',
        'versionId' => 'version_id',
        'parentConversationId' => 'parent_conversation_id',
        'topicIds' => [],
        'excludeStatuses' => [],
        'tagIds' => [],
        'workflowNodeEnteredId' => 'workflow_node_entered_id',
        'terminationReasons' => [],
        'guardrailTypes' => [],
        'customGuardrailNames' => [],
        'sortDirection' => $sortDirection->value
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/conversations$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "conversation_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $agentMessagesPersistedAgentType =
      \ElevenLabs\Types\AgentMessagesPersistedAgentType::Persisted->value;

    $llm = \ElevenLabs\Types\Llm::Gpt4OMini->value;

    $agentMessagesOverrides = new \ElevenLabs\Types\AgentMessagesOverrides([
      'prompt' => 'prompt',
      'llm' => $llm,
      'language' => 'language',
      'toolIds' => [],
      'nativeMcpServerIds' => [],
      'knowledgeBaseIds' => [],
      'procedureIds' => [],
      'customLlmExtraBody' => []
    ]);

    $agentMessagesPersistedAgent = new \ElevenLabs\Types\AgentMessagesPersistedAgent([
      'type' => $agentMessagesPersistedAgentType,
      'agentId' => 'agent_id',
      'branchId' => 'branch_id',
      'overrides' => $agentMessagesOverrides
    ]);

    $request = new \ElevenLabs\Agents\Conversations\Requests\CreateAgentConversationRequest([
      'agent' => $agentMessagesPersistedAgent,
      'environment' => 'environment',
      'userId' => 'user_id',
      'dynamicVariables' => []
    ]);
    $sdk->agents->conversations->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/conversations$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testResolveSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agent_id": "test-value",
          "agent_name": "test-value",
          "conversation_product": "test-value",
          "status": "initiated",
          "user_id": "test-value",
          "branch_id": "test-value",
          "version_id": "test-value",
          "metadata": {
              "start_time_unix_secs": 1,
              "accepted_time_unix_secs": 1,
              "call_duration_secs": 1,
              "queue_wait_secs": 1,
              "cost": 1,
              "deletion_settings": {
                  "deletion_time_unix_secs": 1,
                  "deleted_logs_at_time_unix_secs": 1,
                  "deleted_audio_at_time_unix_secs": 1,
                  "deleted_transcript_at_time_unix_secs": 1,
                  "delete_transcript_and_pii": true,
                  "delete_audio": true
              },
              "feedback": {
                  "type": "thumbs",
                  "overall_score": "like",
                  "likes": 1,
                  "dislikes": 1,
                  "rating": 1,
                  "comment": "test-value"
              },
              "authorization_method": "invalid",
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
              },
              "phone_call": {
                  "direction": "inbound",
                  "phone_number_id": "test-value",
                  "agent_number": "test-value",
                  "external_number": "test-value",
                  "call_result": "answered",
                  "type": "twilio",
                  "stream_sid": "test-value",
                  "call_sid": "test-value"
              },
              "batch_call": {
                  "batch_call_id": "test-value",
                  "batch_call_recipient_id": "test-value",
                  "campaign": {
                      "campaign_id": "test-value",
                      "campaign_lead_id": "test-value",
                      "cold_attempt": 1,
                      "conversation_type": "initial"
                  }
              },
              "termination_reason": "test-value",
              "error": {
                  "code": 1,
                  "reason": "test-value"
              },
              "warnings": [
                  "test-value"
              ],
              "main_language": "test-value",
              "rag_usage": {
                  "usage_count": 1,
                  "embedding_model": "test-value"
              },
              "text_only": true,
              "features_usage": {
                  "language_detection": {
                      "enabled": true,
                      "used": true
                  },
                  "transfer_to_agent": {
                      "enabled": true,
                      "used": true
                  },
                  "transfer_to_number": {
                      "enabled": true,
                      "used": true
                  },
                  "multivoice": {
                      "enabled": true,
                      "used": true
                  },
                  "dtmf_tones": {
                      "enabled": true,
                      "used": true
                  },
                  "external_mcp_servers": {
                      "enabled": true,
                      "used": true
                  },
                  "pii_zrm_workspace": true,
                  "pii_zrm_agent": true,
                  "tool_dynamic_variable_updates": {
                      "enabled": true,
                      "used": true
                  },
                  "is_livekit": true,
                  "voicemail_detection": {
                      "enabled": true,
                      "used": true
                  },
                  "dtmf_input": {
                      "enabled": true,
                      "used": true
                  },
                  "workflow": {
                      "enabled": true,
                      "tool_node": {
                          "enabled": true,
                          "used": true
                      },
                      "standalone_agent_node": {
                          "enabled": true,
                          "used": true
                      },
                      "phone_number_node": {
                          "enabled": true,
                          "used": true
                      },
                      "end_node": {
                          "enabled": true,
                          "used": true
                      },
                      "override_agent_node": {
                          "enabled": true,
                          "used": true
                      }
                  },
                  "agent_testing": {
                      "enabled": true,
                      "tests_ran_after_last_modification": true,
                      "tests_ran_in_last_7_days": true
                  },
                  "versioning": {
                      "enabled": true,
                      "used": true
                  },
                  "file_input": {
                      "enabled": true,
                      "used": true
                  },
                  "freeform_procedure": {
                      "enabled": true,
                      "used": true
                  },
                  "structured_procedure": {
                      "enabled": true,
                      "used": true
                  }
              },
              "eleven_assistant": {
                  "is_eleven_assistant": true
              },
              "initiator_id": "test-value",
              "conversation_initiation_source": "unknown",
              "conversation_initiation_source_version": "test-value",
              "timezone": "test-value",
              "async_metadata": {
                  "delivery_status": "pending",
                  "delivery_timestamp": 1,
                  "delivery_error": "test-value",
                  "external_system": "test-value",
                  "external_id": "test-value",
                  "external_link": "test-value",
                  "retry_count": 1,
                  "last_retry_timestamp": 1,
                  "last_processed_external_message_id": "test-value",
                  "integration_trigger_id": "test-value",
                  "platform_metadata": {
                      "conversation_initiation_source": "plain_integration",
                      "thread_id": "test-value",
                      "workspace_id": "test-value"
                  }
              },
              "whatsapp": {
                  "direction": "inbound",
                  "whatsapp_phone_number_id": "test-value",
                  "whatsapp_user_id": "test-value",
                  "awaiting_first_user_message": true,
                  "recipient": {
                      "phone": "test-value",
                      "bsuid": "test-value"
                  },
                  "call_permission_request": {
                      "state": "blocked",
                      "requested_at_unix": 1,
                      "responded_at_unix": 1,
                      "permanent": true,
                      "granted_by_user_call": true
                  },
                  "call_result": "answered",
                  "opening_message": {
                      "template_name": "test-value",
                      "wamid": "test-value",
                      "sent_at_unix": 1,
                      "delivered_at_unix": 1,
                      "read_at_unix": 1,
                      "replied_at_unix": 1,
                      "failed_at_unix": 1,
                      "error_code": "test-value",
                      "pricing_category": "test-value",
                      "billable": true
                  }
              },
              "sms": {
                  "direction": "inbound",
                  "phone_number_id": "test-value",
                  "sms_user_phone_number": "test-value",
                  "agent_phone_number": "test-value"
              },
              "agent_created_from": "cli",
              "agent_last_updated_from": "cli",
              "voice_rewards": [
                  {
                      "voice_id": "test-value",
                      "reward_usd_cents": 1
                  }
              ],
              "cost_fiat": 1
          },
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
          },
          "user_message_count": 1,
          "agent_message_count": 1,
          "visited_agents": [
              {
                  "agent_id": "test-value",
                  "branch_id": "test-value"
              }
          ],
          "conversation_initiation_client_data": {
              "conversation_config_override": {
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
              "custom_llm_extra_body": {
                  "key": "test-value"
              },
              "user_id": "test-value",
              "source_info": {
                  "source": "unknown",
                  "version": "test-value"
              },
              "branch_id": "test-value",
              "environment": "test-value",
              "starting_workflow_node_id": "test-value",
              "procedure_ids": [
                  "test-value"
              ],
              "start_procedure_ids": [
                  "test-value"
              ],
              "dynamic_variables": {
                  "key": "test-value"
              }
          },
          "environment": "test-value",
          "conversation_id": "test-value",
          "has_audio": true,
          "has_user_audio": true,
          "has_response_audio": true,
          "has_auxiliary_audio": true,
          "transcript": [
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
          "tag_ids": [
              "test-value"
          ],
          "otlp_traces": {
              "key": "test-value"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->conversations->resolve(
      request: new \ElevenLabs\Agents\Conversations\Requests\ResolveConversationsRequest([
        'agentId' => 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
        'reference' => 'https://your-domain.zendesk.com/agent/tickets/12345'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/conversations/resolve$#',
      rawurldecode($sent->getUri()->getPath())
    );
    parse_str($sent->getUri()->getQuery(), $query);
    $this->assertArrayHasKey('agent_id', $query);
    $this->assertArrayHasKey('reference', $query);
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agent_id": "test-value",
          "agent_name": "test-value",
          "conversation_product": "test-value",
          "status": "initiated",
          "user_id": "test-value",
          "branch_id": "test-value",
          "version_id": "test-value",
          "metadata": {
              "start_time_unix_secs": 1,
              "accepted_time_unix_secs": 1,
              "call_duration_secs": 1,
              "queue_wait_secs": 1,
              "cost": 1,
              "deletion_settings": {
                  "deletion_time_unix_secs": 1,
                  "deleted_logs_at_time_unix_secs": 1,
                  "deleted_audio_at_time_unix_secs": 1,
                  "deleted_transcript_at_time_unix_secs": 1,
                  "delete_transcript_and_pii": true,
                  "delete_audio": true
              },
              "feedback": {
                  "type": "thumbs",
                  "overall_score": "like",
                  "likes": 1,
                  "dislikes": 1,
                  "rating": 1,
                  "comment": "test-value"
              },
              "authorization_method": "invalid",
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
              },
              "phone_call": {
                  "direction": "inbound",
                  "phone_number_id": "test-value",
                  "agent_number": "test-value",
                  "external_number": "test-value",
                  "call_result": "answered",
                  "type": "twilio",
                  "stream_sid": "test-value",
                  "call_sid": "test-value"
              },
              "batch_call": {
                  "batch_call_id": "test-value",
                  "batch_call_recipient_id": "test-value",
                  "campaign": {
                      "campaign_id": "test-value",
                      "campaign_lead_id": "test-value",
                      "cold_attempt": 1,
                      "conversation_type": "initial"
                  }
              },
              "termination_reason": "test-value",
              "error": {
                  "code": 1,
                  "reason": "test-value"
              },
              "warnings": [
                  "test-value"
              ],
              "main_language": "test-value",
              "rag_usage": {
                  "usage_count": 1,
                  "embedding_model": "test-value"
              },
              "text_only": true,
              "features_usage": {
                  "language_detection": {
                      "enabled": true,
                      "used": true
                  },
                  "transfer_to_agent": {
                      "enabled": true,
                      "used": true
                  },
                  "transfer_to_number": {
                      "enabled": true,
                      "used": true
                  },
                  "multivoice": {
                      "enabled": true,
                      "used": true
                  },
                  "dtmf_tones": {
                      "enabled": true,
                      "used": true
                  },
                  "external_mcp_servers": {
                      "enabled": true,
                      "used": true
                  },
                  "pii_zrm_workspace": true,
                  "pii_zrm_agent": true,
                  "tool_dynamic_variable_updates": {
                      "enabled": true,
                      "used": true
                  },
                  "is_livekit": true,
                  "voicemail_detection": {
                      "enabled": true,
                      "used": true
                  },
                  "dtmf_input": {
                      "enabled": true,
                      "used": true
                  },
                  "workflow": {
                      "enabled": true,
                      "tool_node": {
                          "enabled": true,
                          "used": true
                      },
                      "standalone_agent_node": {
                          "enabled": true,
                          "used": true
                      },
                      "phone_number_node": {
                          "enabled": true,
                          "used": true
                      },
                      "end_node": {
                          "enabled": true,
                          "used": true
                      },
                      "override_agent_node": {
                          "enabled": true,
                          "used": true
                      }
                  },
                  "agent_testing": {
                      "enabled": true,
                      "tests_ran_after_last_modification": true,
                      "tests_ran_in_last_7_days": true
                  },
                  "versioning": {
                      "enabled": true,
                      "used": true
                  },
                  "file_input": {
                      "enabled": true,
                      "used": true
                  },
                  "freeform_procedure": {
                      "enabled": true,
                      "used": true
                  },
                  "structured_procedure": {
                      "enabled": true,
                      "used": true
                  }
              },
              "eleven_assistant": {
                  "is_eleven_assistant": true
              },
              "initiator_id": "test-value",
              "conversation_initiation_source": "unknown",
              "conversation_initiation_source_version": "test-value",
              "timezone": "test-value",
              "async_metadata": {
                  "delivery_status": "pending",
                  "delivery_timestamp": 1,
                  "delivery_error": "test-value",
                  "external_system": "test-value",
                  "external_id": "test-value",
                  "external_link": "test-value",
                  "retry_count": 1,
                  "last_retry_timestamp": 1,
                  "last_processed_external_message_id": "test-value",
                  "integration_trigger_id": "test-value",
                  "platform_metadata": {
                      "conversation_initiation_source": "plain_integration",
                      "thread_id": "test-value",
                      "workspace_id": "test-value"
                  }
              },
              "whatsapp": {
                  "direction": "inbound",
                  "whatsapp_phone_number_id": "test-value",
                  "whatsapp_user_id": "test-value",
                  "awaiting_first_user_message": true,
                  "recipient": {
                      "phone": "test-value",
                      "bsuid": "test-value"
                  },
                  "call_permission_request": {
                      "state": "blocked",
                      "requested_at_unix": 1,
                      "responded_at_unix": 1,
                      "permanent": true,
                      "granted_by_user_call": true
                  },
                  "call_result": "answered",
                  "opening_message": {
                      "template_name": "test-value",
                      "wamid": "test-value",
                      "sent_at_unix": 1,
                      "delivered_at_unix": 1,
                      "read_at_unix": 1,
                      "replied_at_unix": 1,
                      "failed_at_unix": 1,
                      "error_code": "test-value",
                      "pricing_category": "test-value",
                      "billable": true
                  }
              },
              "sms": {
                  "direction": "inbound",
                  "phone_number_id": "test-value",
                  "sms_user_phone_number": "test-value",
                  "agent_phone_number": "test-value"
              },
              "agent_created_from": "cli",
              "agent_last_updated_from": "cli",
              "voice_rewards": [
                  {
                      "voice_id": "test-value",
                      "reward_usd_cents": 1
                  }
              ],
              "cost_fiat": 1
          },
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
          },
          "user_message_count": 1,
          "agent_message_count": 1,
          "visited_agents": [
              {
                  "agent_id": "test-value",
                  "branch_id": "test-value"
              }
          ],
          "conversation_initiation_client_data": {
              "conversation_config_override": {
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
              "custom_llm_extra_body": {
                  "key": "test-value"
              },
              "user_id": "test-value",
              "source_info": {
                  "source": "unknown",
                  "version": "test-value"
              },
              "branch_id": "test-value",
              "environment": "test-value",
              "starting_workflow_node_id": "test-value",
              "procedure_ids": [
                  "test-value"
              ],
              "start_procedure_ids": [
                  "test-value"
              ],
              "dynamic_variables": {
                  "key": "test-value"
              }
          },
          "environment": "test-value",
          "conversation_id": "test-value",
          "has_audio": true,
          "has_user_audio": true,
          "has_response_audio": true,
          "has_auxiliary_audio": true,
          "transcript": [
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
          "tag_ids": [
              "test-value"
          ],
          "otlp_traces": {
              "key": "test-value"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $format = \ElevenLabs\Agents\Conversations\Types\GetConversationsRequestFormat::Json;
    $sdk->agents->conversations->get(
      request: new \ElevenLabs\Agents\Conversations\Requests\GetConversationsRequest([
        'format' => $format->value
      ]),
      conversationId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/conversations/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->conversations->delete(conversationId: '21m00Tcm4TlvDq8ikWAM');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/conversations/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetSummarySendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "conversation_id": "test-value",
          "agent_id": "test-value",
          "status": "initiated",
          "call_summary_title": "test-value",
          "transcript_summary": "test-value",
          "call_successful": "success",
          "message_count": 1,
          "messages": [
              {
                  "role": "user",
                  "message": "test-value"
              }
          ],
          "messages_omitted": true,
          "note": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->conversations->getSummary(
      request: new \ElevenLabs\Agents\Conversations\Requests\GetSummaryConversationsRequest([
        'maxMessages' => 40
      ]),
      conversationId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/conversations/[^/]+/summary$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetSipMessagesSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "sip_messages": [
              {
                  "call_id": "test-value",
                  "phone_numbers": [
                      "test-value"
                  ],
                  "local_address": "test-value",
                  "remote_address": "test-value",
                  "transport": "test-value",
                  "raw_message": "test-value",
                  "error_message": "test-value",
                  "direction": "in",
                  "created_at_unix_micro": 1
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->conversations->getSipMessages(
      request: new \ElevenLabs\Agents\Conversations\Requests\GetSipMessagesConversationsRequest([
        'pageSize' => 20,
        'cursor' => 'cursor'
      ]),
      conversationId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/conversations/[^/]+/sip-messages$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testSendMessageSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "turn_id": "test-value",
          "status": "in_progress",
          "output": [
              {
                  "type": "text",
                  "role": "agent",
                  "id": "test-value",
                  "text": "test-value",
                  "created_at_unix_ms": 1
              }
          ],
          "error": {
              "type": "test-value",
              "code": "test-value",
              "message": "test-value"
          },
          "required_actions": [
              {
                  "type": "client_tool_call",
                  "tool_call_id": "test-value",
                  "tool_name": "test-value",
                  "parameters": {
                      "key": "test-value"
                  }
              }
          ],
          "stream_cursor": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $userMessageInputItemType = \ElevenLabs\Types\UserMessageInputItemType::UserMessage->value;

    $textContentPartType = \ElevenLabs\Types\TextContentPartType::Text->value;

    $textContentPart = new \ElevenLabs\Types\TextContentPart([
      'type' => $textContentPartType,
      'text' => 'text'
    ]);
    $userMessageInputItemContentItem = \ElevenLabs\Types\UserMessageInputItemContentItem::text(
      $textContentPart
    );

    $userMessageInputItem = new \ElevenLabs\Types\UserMessageInputItem([
      'type' => $userMessageInputItemType,
      'content' => [$userMessageInputItemContentItem]
    ]);
    $sendConversationMessageRequestInputItem = \ElevenLabs\Agents\Conversations\Types\SendConversationMessageRequestInputItem::userMessage(
      $userMessageInputItem
    );

    $request = new \ElevenLabs\Agents\Conversations\Requests\SendConversationMessageRequest([
      'input' => [$sendConversationMessageRequestInputItem],
      'background' => true
    ]);
    $sdk->agents->conversations->sendMessage(request: $request, conversationId: 'conversation_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/conversations/[^/]+/messages$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testGetTurnSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "turn_id": "test-value",
          "status": "in_progress",
          "output": [
              {
                  "type": "text",
                  "role": "agent",
                  "id": "test-value",
                  "text": "test-value",
                  "created_at_unix_ms": 1
              }
          ],
          "error": {
              "type": "test-value",
              "code": "test-value",
              "message": "test-value"
          },
          "required_actions": [
              {
                  "type": "client_tool_call",
                  "tool_call_id": "test-value",
                  "tool_name": "test-value",
                  "parameters": {
                      "key": "test-value"
                  }
              }
          ],
          "stream_cursor": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->conversations->getTurn(conversationId: 'conversation_id', turnId: '223');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/conversations/[^/]+/turns/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
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

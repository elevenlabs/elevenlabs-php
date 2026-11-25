<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Tests;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class TestsWireTest extends TestCase
{
  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $conversationHistoryTranscriptCommonModelInputRole =
      \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelInputRole::User->value;

    $agentMetadata = new \ElevenLabs\Types\AgentMetadata([
      'agentId' => 'agent_id',
      'branchId' => 'branch_id',
      'workflowNodeId' => 'workflow_node_id',
      'versionId' => 'version_id'
    ]);

    $conversationHistoryMultivoiceMessagePartModel = new \ElevenLabs\Types\ConversationHistoryMultivoiceMessagePartModel(
      [
        'text' => 'text',
        'voiceLabel' => 'voice_label',
        'timeInCallSecs' => 6
      ]
    );

    $conversationHistoryMultivoiceMessageModel = new \ElevenLabs\Types\ConversationHistoryMultivoiceMessageModel(
      [
        'parts' => []
      ]
    );

    $toolType = \ElevenLabs\Types\ToolType::System->value;

    $conversationHistoryTranscriptToolCallWebhookDetailsType =
      \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetailsType::Webhook->value;

    $conversationHistoryTranscriptToolCallWebhookDetails = new \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails(
      [
        'type' => $conversationHistoryTranscriptToolCallWebhookDetailsType,
        'method' => 'method',
        'url' => 'url',
        'headers' => [],
        'pathParams' => [],
        'queryParams' => [],
        'body' => 'body'
      ]
    );
    $conversationHistoryTranscriptToolCallCommonModelInputToolDetails = \ElevenLabs\Types\ConversationHistoryTranscriptToolCallCommonModelInputToolDetails::webhook(
      $conversationHistoryTranscriptToolCallWebhookDetails
    );

    $conversationHistoryTranscriptToolCallCommonModelInput = new \ElevenLabs\Types\ConversationHistoryTranscriptToolCallCommonModelInput(
      [
        'type' => $toolType,
        'requestId' => 'request_id',
        'toolName' => 'tool_name',
        'toolId' => 'tool_id',
        'paramsAsJson' => 'params_as_json',
        'toolHasBeenCalled' => true,
        'toolDetails' => $conversationHistoryTranscriptToolCallCommonModelInputToolDetails
      ]
    );

    $dynamicVariableUpdateCommonModel = new \ElevenLabs\Types\DynamicVariableUpdateCommonModel([
      'variableName' => 'variable_name',
      'oldValue' => 'old_value',
      'newValue' => 'new_value',
      'updatedAt' => 7.02,
      'toolName' => 'tool_name',
      'toolRequestId' => 'tool_request_id'
    ]);

    $conversationHistoryTranscriptOtherToolsResultCommonModelType =
      \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModelType::Client->value;

    $conversationHistoryTranscriptCommonModelInputToolResultsItem = new \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel(
      [
        'requestId' => 'request_id',
        'toolName' => 'tool_name',
        'toolId' => 'tool_id',
        'resultValue' => 'result_value',
        'isError' => false,
        'isBlocked' => true,
        'toolHasBeenCalled' => true,
        'toolLatencySecs' => 6.17,
        'errorType' => 'error_type',
        'rawErrorMessage' => 'raw_error_message',
        'dynamicVariableUpdates' => [],
        'type' => $conversationHistoryTranscriptOtherToolsResultCommonModelType
      ]
    );

    $userFeedbackScore = \ElevenLabs\Types\UserFeedbackScore::Like->value;

    $userFeedback = new \ElevenLabs\Types\UserFeedback([
      'score' => $userFeedbackScore,
      'timeInCallSecs' => 10
    ]);

    $metricRecord = new \ElevenLabs\Types\MetricRecord([
      'elapsedTime' => 6.47
    ]);

    $conversationTurnMetrics = new \ElevenLabs\Types\ConversationTurnMetrics([
      'metrics' => [],
      'convaiAsrProvider' => 'convai_asr_provider',
      'convaiTtsModel' => 'convai_tts_model',
      'convaiTtsCascade' => 'convai_tts_cascade',
      'voiceId' => 'voice_id'
    ]);

    $ragChunkMetadata = new \ElevenLabs\Types\RagChunkMetadata([
      'documentId' => 'document_id',
      'chunkId' => 'chunk_id',
      'vectorDistance' => 0.28
    ]);

    $embeddingModelEnum = \ElevenLabs\Types\EmbeddingModelEnum::E5Mistral7BInstruct->value;

    $ragRetrievalInfo = new \ElevenLabs\Types\RagRetrievalInfo([
      'chunks' => [],
      'embeddingModel' => $embeddingModelEnum,
      'retrievalQuery' => 'retrieval_query',
      'ragLatencySecs' => 3.59,
      'usedChunkIds' => []
    ]);

    $llmTokensCategoryUsage = new \ElevenLabs\Types\LlmTokensCategoryUsage([
      'tokens' => 5,
      'price' => 0.97
    ]);

    $llmInputOutputTokensUsage = new \ElevenLabs\Types\LlmInputOutputTokensUsage([
      'input' => $llmTokensCategoryUsage,
      'inputCacheRead' => $llmTokensCategoryUsage,
      'inputCacheWrite' => $llmTokensCategoryUsage,
      'outputTotal' => $llmTokensCategoryUsage,
      'outputTotalReasoningPortion' => $llmTokensCategoryUsage
    ]);

    $llmUsageInput = new \ElevenLabs\Types\LlmUsageInput([
      'modelUsage' => []
    ]);

    $transcriptPlatformEvent = \ElevenLabs\Types\TranscriptPlatformEvent::UserTurnTimeout->value;

    $conversationReasoningModel = new \ElevenLabs\Types\ConversationReasoningModel([
      'summary' => 'summary',
      'providerRedact' => true
    ]);

    $chatSourceMedium = \ElevenLabs\Types\ChatSourceMedium::Audio->value;

    $guardrailType = \ElevenLabs\Types\GuardrailType::Custom->value;

    $guardrailExecutionMode = \ElevenLabs\Types\GuardrailExecutionMode::Streaming->value;

    $guardrailLlmVerdictType = \ElevenLabs\Types\GuardrailLlmVerdictType::Llm->value;

    $guardrailLlmVerdict = new \ElevenLabs\Types\GuardrailLlmVerdict([
      'type' => $guardrailLlmVerdictType,
      'rationale' => 'rationale'
    ]);
    $triggeredGuardrailCommonModelGuardrailDetails = \ElevenLabs\Types\TriggeredGuardrailCommonModelGuardrailDetails::llm(
      $guardrailLlmVerdict
    );

    $triggeredGuardrailCommonModel = new \ElevenLabs\Types\TriggeredGuardrailCommonModel([
      'guardrailType' => $guardrailType,
      'guardrailName' => 'guardrail_name',
      'executionMode' => $guardrailExecutionMode,
      'guardrailDetails' => $triggeredGuardrailCommonModelGuardrailDetails
    ]);

    $conversationHistoryTranscriptCommonModelInput = new \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelInput(
      [
        'role' => $conversationHistoryTranscriptCommonModelInputRole,
        'agentMetadata' => $agentMetadata,
        'message' => 'message',
        'multivoiceMessage' => $conversationHistoryMultivoiceMessageModel,
        'toolCalls' => [],
        'toolResults' => [],
        'feedback' => $userFeedback,
        'llmOverride' => 'llm_override',
        'producingLlm' => 'producing_llm',
        'timeInCallSecs' => 5,
        'conversationTurnMetrics' => $conversationTurnMetrics,
        'ragRetrievalInfo' => $ragRetrievalInfo,
        'llmUsage' => $llmUsageInput,
        'interrupted' => true,
        'ignoredAsBackchannel' => true,
        'platformEvent' => $transcriptPlatformEvent,
        'originalMessage' => 'original_message',
        'reasoning' => [],
        'sourceMedium' => $chatSourceMedium,
        'sourceEventId' => 2,
        'usedStaticKbDocumentIds' => [],
        'userIdentifier' => 'user_identifier',
        'id' => 'id',
        'createdAtUnixMs' => 0,
        'triggeredGuardrails' => []
      ]
    );

    $testFromConversationMetadataInput = new \ElevenLabs\Types\TestFromConversationMetadataInput([
      'conversationId' => 'conversation_id',
      'agentId' => 'agent_id',
      'branchId' => 'branch_id',
      'workflowNodeId' => 'workflow_node_id',
      'originalAgentReply' => []
    ]);

    $conversationHistoryTranscriptCommonModelInput = new \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelInput(
      [
        'role' => $conversationHistoryTranscriptCommonModelInputRole,
        'agentMetadata' => $agentMetadata,
        'message' => 'message',
        'multivoiceMessage' => $conversationHistoryMultivoiceMessageModel,
        'toolCalls' => [],
        'toolResults' => [],
        'feedback' => $userFeedback,
        'llmOverride' => 'llm_override',
        'producingLlm' => 'producing_llm',
        'timeInCallSecs' => 5,
        'conversationTurnMetrics' => $conversationTurnMetrics,
        'ragRetrievalInfo' => $ragRetrievalInfo,
        'llmUsage' => $llmUsageInput,
        'interrupted' => true,
        'ignoredAsBackchannel' => true,
        'platformEvent' => $transcriptPlatformEvent,
        'originalMessage' => 'original_message',
        'reasoning' => [],
        'sourceMedium' => $chatSourceMedium,
        'sourceEventId' => 2,
        'usedStaticKbDocumentIds' => [],
        'userIdentifier' => 'user_identifier',
        'id' => 'id',
        'createdAtUnixMs' => 0,
        'triggeredGuardrails' => []
      ]
    );

    $conversationInitiationSource = \ElevenLabs\Types\ConversationInitiationSource::Unknown->value;

    $createResponseUnitTestRequestType =
      \ElevenLabs\Types\CreateResponseUnitTestRequestType::Llm->value;

    $agentSuccessfulResponseExampleType =
      \ElevenLabs\Types\AgentSuccessfulResponseExampleType::Success->value;

    $agentSuccessfulResponseExample = new \ElevenLabs\Types\AgentSuccessfulResponseExample([
      'response' => 'response',
      'type' => $agentSuccessfulResponseExampleType
    ]);

    $agentFailureResponseExampleType =
      \ElevenLabs\Types\AgentFailureResponseExampleType::Failure->value;

    $agentFailureResponseExample = new \ElevenLabs\Types\AgentFailureResponseExample([
      'response' => 'response',
      'type' => $agentFailureResponseExampleType
    ]);

    $request = new \ElevenLabs\Types\CreateResponseUnitTestRequest([
      'fromConversationMetadata' => $testFromConversationMetadataInput,
      'dynamicVariables' => [],
      'chatHistory' => [],
      'conversationInitiationSource' => $conversationInitiationSource,
      'environment' => 'environment',
      'type' => $createResponseUnitTestRequestType,
      'successCondition' => 'success_condition',
      'successExamples' => [],
      'failureExamples' => [],
      'name' => 'name',
      'parentFolderId' => 'parent_folder_id'
    ]);
    $sdk->agents->tests->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agent-testing/create$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testMoveSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\Tests\Requests\BodyBulkMoveTestsToFolderV1ConvaiAgentTestingBulkMovePost(
      [
        'entityIds' => ['entity_ids'],
        'moveTo' => 'move_to'
      ]
    );
    $sdk->agents->tests->move(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agent-testing/bulk-move$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
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
          ],
          "id": "test-value",
          "name": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->tests->get(testId: 'TeaqRRdTcIfIu2i7BYfT');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agent-testing/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
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
          ],
          "id": "test-value",
          "name": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $conversationHistoryTranscriptCommonModelInputRole =
      \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelInputRole::User->value;

    $agentMetadata = new \ElevenLabs\Types\AgentMetadata([
      'agentId' => 'agent_id',
      'branchId' => 'branch_id',
      'workflowNodeId' => 'workflow_node_id',
      'versionId' => 'version_id'
    ]);

    $conversationHistoryMultivoiceMessagePartModel = new \ElevenLabs\Types\ConversationHistoryMultivoiceMessagePartModel(
      [
        'text' => 'text',
        'voiceLabel' => 'voice_label',
        'timeInCallSecs' => 6
      ]
    );

    $conversationHistoryMultivoiceMessageModel = new \ElevenLabs\Types\ConversationHistoryMultivoiceMessageModel(
      [
        'parts' => []
      ]
    );

    $toolType = \ElevenLabs\Types\ToolType::System->value;

    $conversationHistoryTranscriptToolCallWebhookDetailsType =
      \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetailsType::Webhook->value;

    $conversationHistoryTranscriptToolCallWebhookDetails = new \ElevenLabs\Types\ConversationHistoryTranscriptToolCallWebhookDetails(
      [
        'type' => $conversationHistoryTranscriptToolCallWebhookDetailsType,
        'method' => 'method',
        'url' => 'url',
        'headers' => [],
        'pathParams' => [],
        'queryParams' => [],
        'body' => 'body'
      ]
    );
    $conversationHistoryTranscriptToolCallCommonModelInputToolDetails = \ElevenLabs\Types\ConversationHistoryTranscriptToolCallCommonModelInputToolDetails::webhook(
      $conversationHistoryTranscriptToolCallWebhookDetails
    );

    $conversationHistoryTranscriptToolCallCommonModelInput = new \ElevenLabs\Types\ConversationHistoryTranscriptToolCallCommonModelInput(
      [
        'type' => $toolType,
        'requestId' => 'request_id',
        'toolName' => 'tool_name',
        'toolId' => 'tool_id',
        'paramsAsJson' => 'params_as_json',
        'toolHasBeenCalled' => true,
        'toolDetails' => $conversationHistoryTranscriptToolCallCommonModelInputToolDetails
      ]
    );

    $dynamicVariableUpdateCommonModel = new \ElevenLabs\Types\DynamicVariableUpdateCommonModel([
      'variableName' => 'variable_name',
      'oldValue' => 'old_value',
      'newValue' => 'new_value',
      'updatedAt' => 7.02,
      'toolName' => 'tool_name',
      'toolRequestId' => 'tool_request_id'
    ]);

    $conversationHistoryTranscriptOtherToolsResultCommonModelType =
      \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModelType::Client->value;

    $conversationHistoryTranscriptCommonModelInputToolResultsItem = new \ElevenLabs\Types\ConversationHistoryTranscriptOtherToolsResultCommonModel(
      [
        'requestId' => 'request_id',
        'toolName' => 'tool_name',
        'toolId' => 'tool_id',
        'resultValue' => 'result_value',
        'isError' => false,
        'isBlocked' => true,
        'toolHasBeenCalled' => true,
        'toolLatencySecs' => 6.17,
        'errorType' => 'error_type',
        'rawErrorMessage' => 'raw_error_message',
        'dynamicVariableUpdates' => [],
        'type' => $conversationHistoryTranscriptOtherToolsResultCommonModelType
      ]
    );

    $userFeedbackScore = \ElevenLabs\Types\UserFeedbackScore::Like->value;

    $userFeedback = new \ElevenLabs\Types\UserFeedback([
      'score' => $userFeedbackScore,
      'timeInCallSecs' => 10
    ]);

    $metricRecord = new \ElevenLabs\Types\MetricRecord([
      'elapsedTime' => 6.47
    ]);

    $conversationTurnMetrics = new \ElevenLabs\Types\ConversationTurnMetrics([
      'metrics' => [],
      'convaiAsrProvider' => 'convai_asr_provider',
      'convaiTtsModel' => 'convai_tts_model',
      'convaiTtsCascade' => 'convai_tts_cascade',
      'voiceId' => 'voice_id'
    ]);

    $ragChunkMetadata = new \ElevenLabs\Types\RagChunkMetadata([
      'documentId' => 'document_id',
      'chunkId' => 'chunk_id',
      'vectorDistance' => 0.28
    ]);

    $embeddingModelEnum = \ElevenLabs\Types\EmbeddingModelEnum::E5Mistral7BInstruct->value;

    $ragRetrievalInfo = new \ElevenLabs\Types\RagRetrievalInfo([
      'chunks' => [],
      'embeddingModel' => $embeddingModelEnum,
      'retrievalQuery' => 'retrieval_query',
      'ragLatencySecs' => 3.59,
      'usedChunkIds' => []
    ]);

    $llmTokensCategoryUsage = new \ElevenLabs\Types\LlmTokensCategoryUsage([
      'tokens' => 5,
      'price' => 0.97
    ]);

    $llmInputOutputTokensUsage = new \ElevenLabs\Types\LlmInputOutputTokensUsage([
      'input' => $llmTokensCategoryUsage,
      'inputCacheRead' => $llmTokensCategoryUsage,
      'inputCacheWrite' => $llmTokensCategoryUsage,
      'outputTotal' => $llmTokensCategoryUsage,
      'outputTotalReasoningPortion' => $llmTokensCategoryUsage
    ]);

    $llmUsageInput = new \ElevenLabs\Types\LlmUsageInput([
      'modelUsage' => []
    ]);

    $transcriptPlatformEvent = \ElevenLabs\Types\TranscriptPlatformEvent::UserTurnTimeout->value;

    $conversationReasoningModel = new \ElevenLabs\Types\ConversationReasoningModel([
      'summary' => 'summary',
      'providerRedact' => true
    ]);

    $chatSourceMedium = \ElevenLabs\Types\ChatSourceMedium::Audio->value;

    $guardrailType = \ElevenLabs\Types\GuardrailType::Custom->value;

    $guardrailExecutionMode = \ElevenLabs\Types\GuardrailExecutionMode::Streaming->value;

    $guardrailLlmVerdictType = \ElevenLabs\Types\GuardrailLlmVerdictType::Llm->value;

    $guardrailLlmVerdict = new \ElevenLabs\Types\GuardrailLlmVerdict([
      'type' => $guardrailLlmVerdictType,
      'rationale' => 'rationale'
    ]);
    $triggeredGuardrailCommonModelGuardrailDetails = \ElevenLabs\Types\TriggeredGuardrailCommonModelGuardrailDetails::llm(
      $guardrailLlmVerdict
    );

    $triggeredGuardrailCommonModel = new \ElevenLabs\Types\TriggeredGuardrailCommonModel([
      'guardrailType' => $guardrailType,
      'guardrailName' => 'guardrail_name',
      'executionMode' => $guardrailExecutionMode,
      'guardrailDetails' => $triggeredGuardrailCommonModelGuardrailDetails
    ]);

    $conversationHistoryTranscriptCommonModelInput = new \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelInput(
      [
        'role' => $conversationHistoryTranscriptCommonModelInputRole,
        'agentMetadata' => $agentMetadata,
        'message' => 'message',
        'multivoiceMessage' => $conversationHistoryMultivoiceMessageModel,
        'toolCalls' => [],
        'toolResults' => [],
        'feedback' => $userFeedback,
        'llmOverride' => 'llm_override',
        'producingLlm' => 'producing_llm',
        'timeInCallSecs' => 5,
        'conversationTurnMetrics' => $conversationTurnMetrics,
        'ragRetrievalInfo' => $ragRetrievalInfo,
        'llmUsage' => $llmUsageInput,
        'interrupted' => true,
        'ignoredAsBackchannel' => true,
        'platformEvent' => $transcriptPlatformEvent,
        'originalMessage' => 'original_message',
        'reasoning' => [],
        'sourceMedium' => $chatSourceMedium,
        'sourceEventId' => 2,
        'usedStaticKbDocumentIds' => [],
        'userIdentifier' => 'user_identifier',
        'id' => 'id',
        'createdAtUnixMs' => 0,
        'triggeredGuardrails' => []
      ]
    );

    $testFromConversationMetadataInput = new \ElevenLabs\Types\TestFromConversationMetadataInput([
      'conversationId' => 'conversation_id',
      'agentId' => 'agent_id',
      'branchId' => 'branch_id',
      'workflowNodeId' => 'workflow_node_id',
      'originalAgentReply' => []
    ]);

    $conversationHistoryTranscriptCommonModelInput = new \ElevenLabs\Types\ConversationHistoryTranscriptCommonModelInput(
      [
        'role' => $conversationHistoryTranscriptCommonModelInputRole,
        'agentMetadata' => $agentMetadata,
        'message' => 'message',
        'multivoiceMessage' => $conversationHistoryMultivoiceMessageModel,
        'toolCalls' => [],
        'toolResults' => [],
        'feedback' => $userFeedback,
        'llmOverride' => 'llm_override',
        'producingLlm' => 'producing_llm',
        'timeInCallSecs' => 5,
        'conversationTurnMetrics' => $conversationTurnMetrics,
        'ragRetrievalInfo' => $ragRetrievalInfo,
        'llmUsage' => $llmUsageInput,
        'interrupted' => true,
        'ignoredAsBackchannel' => true,
        'platformEvent' => $transcriptPlatformEvent,
        'originalMessage' => 'original_message',
        'reasoning' => [],
        'sourceMedium' => $chatSourceMedium,
        'sourceEventId' => 2,
        'usedStaticKbDocumentIds' => [],
        'userIdentifier' => 'user_identifier',
        'id' => 'id',
        'createdAtUnixMs' => 0,
        'triggeredGuardrails' => []
      ]
    );

    $conversationInitiationSource = \ElevenLabs\Types\ConversationInitiationSource::Unknown->value;

    $updateResponseUnitTestRequestType =
      \ElevenLabs\Types\UpdateResponseUnitTestRequestType::Llm->value;

    $agentSuccessfulResponseExampleType =
      \ElevenLabs\Types\AgentSuccessfulResponseExampleType::Success->value;

    $agentSuccessfulResponseExample = new \ElevenLabs\Types\AgentSuccessfulResponseExample([
      'response' => 'response',
      'type' => $agentSuccessfulResponseExampleType
    ]);

    $agentFailureResponseExampleType =
      \ElevenLabs\Types\AgentFailureResponseExampleType::Failure->value;

    $agentFailureResponseExample = new \ElevenLabs\Types\AgentFailureResponseExample([
      'response' => 'response',
      'type' => $agentFailureResponseExampleType
    ]);

    $request = new \ElevenLabs\Types\UpdateResponseUnitTestRequest([
      'fromConversationMetadata' => $testFromConversationMetadataInput,
      'dynamicVariables' => [],
      'chatHistory' => [],
      'conversationInitiationSource' => $conversationInitiationSource,
      'environment' => 'environment',
      'type' => $updateResponseUnitTestRequestType,
      'successCondition' => 'success_condition',
      'successExamples' => [],
      'failureExamples' => [],
      'name' => 'name',
      'parentFolderId' => 'parent_folder_id'
    ]);
    $sdk->agents->tests->update(request: $request, testId: 'TeaqRRdTcIfIu2i7BYfT');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PUT', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agent-testing/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
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
    $sdk->agents->tests->delete(testId: 'TeaqRRdTcIfIu2i7BYfT');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agent-testing/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testSummariesSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "tests": {
              "key": {
                  "id": "test-value",
                  "name": "test-value",
                  "access_info": {
                      "is_creator": true,
                      "creator_name": "test-value",
                      "creator_email": "test-value",
                      "role": "admin",
                      "anonymous_access_level_override": "admin",
                      "access_source": "creator"
                  },
                  "created_at_unix_secs": 1,
                  "last_updated_at_unix_secs": 1,
                  "type": "llm",
                  "entity_type": "test",
                  "folder_parent_id": "test-value",
                  "folder_path": [
                      {
                          "id": "test-value",
                          "name": "test-value"
                      }
                  ],
                  "children_count": 1,
                  "conversation_initiation_source": "unknown"
              }
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\Tests\Requests\ListTestsByIdsRequestModel([
      'testIds' => []
    ]);
    $sdk->agents->tests->summaries(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agent-testing/summaries$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "tests": [
              {
                  "id": "test-value",
                  "name": "test-value",
                  "access_info": {
                      "is_creator": true,
                      "creator_name": "test-value",
                      "creator_email": "test-value",
                      "role": "admin",
                      "anonymous_access_level_override": "admin",
                      "access_source": "creator"
                  },
                  "created_at_unix_secs": 1,
                  "last_updated_at_unix_secs": 1,
                  "type": "llm",
                  "entity_type": "test",
                  "folder_parent_id": "test-value",
                  "folder_path": [
                      {
                          "id": "test-value",
                          "name": "test-value"
                      }
                  ],
                  "children_count": 1,
                  "conversation_initiation_source": "unknown"
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sortMode = \ElevenLabs\Agents\Tests\Types\ListTestsRequestSortMode::Default_;
    $sharingMode = \ElevenLabs\Types\TestSharingMode::All;
    $sdk->agents->tests->list(
      request: new \ElevenLabs\Agents\Tests\Requests\ListTestsRequest([
        'cursor' => 'cursor',
        'pageSize' => 30,
        'search' => 'search',
        'parentFolderId' => 'parent_folder_id',
        'types' => [],
        'includeFolders' => false,
        'sortMode' => $sortMode->value,
        'sharingMode' => $sharingMode->value,
        'createdByUserId' => 'created_by_user_id'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agent-testing$#',
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

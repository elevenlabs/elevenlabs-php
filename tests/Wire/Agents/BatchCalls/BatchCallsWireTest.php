<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\BatchCalls;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class BatchCallsWireTest extends TestCase
{
  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "phone_number_id": "test-value",
          "phone_provider": "twilio",
          "whatsapp_params": {
              "whatsapp_phone_number_id": "test-value",
              "whatsapp_call_permission_request_template_name": "test-value",
              "whatsapp_call_permission_request_template_language_code": "test-value"
          },
          "name": "test-value",
          "agent_id": "test-value",
          "branch_id": "test-value",
          "environment": "test-value",
          "created_at_unix": 1,
          "scheduled_time_unix": 1,
          "timezone": "test-value",
          "total_calls_dispatched": 1,
          "total_calls_scheduled": 1,
          "total_calls_finished": 1,
          "last_updated_at_unix": 1,
          "status": "pending",
          "retry_count": 1,
          "telephony_call_config": {
              "ringing_timeout_secs": 1,
              "twilio_call_recording_enabled": true,
              "twilio_machine_detection": {
                  "mode": "enable",
                  "actions": [
                      {
                          "action": "hang_up",
                          "answered_by": [
                              "human"
                          ]
                      }
                  ]
              }
          },
          "target_concurrency_limit": 1,
          "agent_name": "test-value",
          "branch_name": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

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
      'stability' => 0.56,
      'speed' => 0.83,
      'similarityBoost' => 0.04,
      'cloneStrength' => 0.3
    ]);

    $pydanticPronunciationDictionaryVersionLocator = new \ElevenLabs\Types\PydanticPronunciationDictionaryVersionLocator(
      [
        'pronunciationDictionaryId' => 'pronunciation_dictionary_id',
        'versionId' => 'version_id'
      ]
    );

    $ttsConversationalConfigOverride = new \ElevenLabs\Types\TtsConversationalConfigOverride([
      'modelId' => $ttsConversationalModel,
      'voiceId' => 'voice_id',
      'supportedVoices' => [],
      'stability' => 4.99,
      'speed' => 7.29,
      'similarityBoost' => 5.75,
      'cloneStrength' => 5.08,
      'pronunciationDictionaryLocators' => []
    ]);

    $conversationConfigOverride = new \ElevenLabs\Types\ConversationConfigOverride([
      'textOnly' => true,
      'maxDurationSeconds' => 9
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

    $promptAgentApiModelOverrideInput = new \ElevenLabs\Types\PromptAgentApiModelOverrideInput([
      'prompt' => 'prompt',
      'llm' => $llm,
      'reasoningEffort' => $llmReasoningEffort,
      'toolIds' => [],
      'toolIdsStrict' => true,
      'nativeMcpServerIds' => [],
      'knowledgeBase' => []
    ]);

    $agentConfigOverrideInput = new \ElevenLabs\Types\AgentConfigOverrideInput([
      'firstMessage' => 'first_message',
      'language' => 'language',
      'maxConversationDurationMessage' => 'max_conversation_duration_message',
      'prompt' => $promptAgentApiModelOverrideInput
    ]);

    $conversationConfigClientOverrideInput = new \ElevenLabs\Types\ConversationConfigClientOverrideInput(
      [
        'asr' => $asrConversationalConfigOverride,
        'turn' => $turnConfigOverride,
        'tts' => $ttsConversationalConfigOverride,
        'conversation' => $conversationConfigOverride,
        'agent' => $agentConfigOverrideInput
      ]
    );

    $conversationInitiationSource = \ElevenLabs\Types\ConversationInitiationSource::Unknown->value;

    $conversationInitiationSourceInfo = new \ElevenLabs\Types\ConversationInitiationSourceInfo([
      'source' => $conversationInitiationSource,
      'version' => 'version'
    ]);

    $conversationInitiationClientDataRequestInput = new \ElevenLabs\Types\ConversationInitiationClientDataRequestInput(
      [
        'conversationConfigOverride' => $conversationConfigClientOverrideInput,
        'customLlmExtraBody' => [],
        'userId' => 'user_id',
        'sourceInfo' => $conversationInitiationSourceInfo,
        'branchId' => 'branch_id',
        'environment' => 'environment',
        'startingWorkflowNodeId' => 'starting_workflow_node_id',
        'procedureIds' => [],
        'startProcedureIds' => [],
        'dynamicVariables' => []
      ]
    );

    $outboundCallRecipient = new \ElevenLabs\Types\OutboundCallRecipient([
      'id' => 'id',
      'phoneNumber' => 'phone_number',
      'whatsappUserId' => 'whatsapp_user_id',
      'conversationInitiationClientData' => $conversationInitiationClientDataRequestInput
    ]);

    $batchCallWhatsAppParams = new \ElevenLabs\Types\BatchCallWhatsAppParams([
      'whatsappPhoneNumberId' => 'whatsapp_phone_number_id',
      'whatsappCallPermissionRequestTemplateName' =>
        'whatsapp_call_permission_request_template_name',
      'whatsappCallPermissionRequestTemplateLanguageCode' =>
        'whatsapp_call_permission_request_template_language_code'
    ]);

    $twilioMachineDetectionMode = \ElevenLabs\Types\TwilioMachineDetectionMode::Enable->value;

    $twilioMachineDetectionAction = \ElevenLabs\Types\TwilioMachineDetectionAction::HangUp->value;

    $twilioAnsweredBy = \ElevenLabs\Types\TwilioAnsweredBy::Human->value;

    $twilioMachineDetectionRule = new \ElevenLabs\Types\TwilioMachineDetectionRule([
      'action' => $twilioMachineDetectionAction,
      'answeredBy' => [$twilioAnsweredBy]
    ]);

    $twilioMachineDetectionConfig = new \ElevenLabs\Types\TwilioMachineDetectionConfig([
      'mode' => $twilioMachineDetectionMode,
      'actions' => []
    ]);

    $telephonyCallConfigInput = new \ElevenLabs\Types\TelephonyCallConfigInput([
      'ringingTimeoutSecs' => 60,
      'twilioCallRecordingEnabled' => false,
      'twilioMachineDetection' => $twilioMachineDetectionConfig
    ]);

    $request = new \ElevenLabs\Agents\BatchCalls\Requests\BodySubmitABatchCallRequestV1ConvaiBatchCallingSubmitPost(
      [
        'callName' => 'call_name',
        'agentId' => 'agent_id',
        'recipients' => [],
        'scheduledTimeUnix' => 9,
        'agentPhoneNumberId' => 'agent_phone_number_id',
        'whatsappParams' => $batchCallWhatsAppParams,
        'timezone' => 'timezone',
        'branchId' => 'branch_id',
        'environment' => 'environment',
        'telephonyCallConfig' => $telephonyCallConfigInput,
        'targetConcurrencyLimit' => 1
      ]
    );
    $sdk->agents->batchCalls->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/batch-calling/submit$#',
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
          "batch_calls": [
              {
                  "id": "test-value",
                  "phone_number_id": "test-value",
                  "phone_provider": "twilio",
                  "whatsapp_params": {
                      "whatsapp_phone_number_id": "test-value",
                      "whatsapp_call_permission_request_template_name": "test-value",
                      "whatsapp_call_permission_request_template_language_code": "test-value"
                  },
                  "name": "test-value",
                  "agent_id": "test-value",
                  "branch_id": "test-value",
                  "environment": "test-value",
                  "created_at_unix": 1,
                  "scheduled_time_unix": 1,
                  "timezone": "test-value",
                  "total_calls_dispatched": 1,
                  "total_calls_scheduled": 1,
                  "total_calls_finished": 1,
                  "last_updated_at_unix": 1,
                  "status": "pending",
                  "retry_count": 1,
                  "telephony_call_config": {
                      "ringing_timeout_secs": 1,
                      "twilio_call_recording_enabled": true,
                      "twilio_machine_detection": {
                          "mode": "enable",
                          "actions": [
                              {
                                  "action": "hang_up",
                                  "answered_by": [
                                      "human"
                                  ]
                              }
                          ]
                      }
                  },
                  "target_concurrency_limit": 1,
                  "agent_name": "test-value",
                  "branch_name": "test-value"
              }
          ],
          "next_doc": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->batchCalls->list(
      request: new \ElevenLabs\Agents\BatchCalls\Requests\ListBatchCallsRequest([
        'limit' => 100,
        'lastDoc' => 'last_doc',
        'agentId' => 'agent_id'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/batch-calling/workspace$#',
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
          "phone_number_id": "test-value",
          "phone_provider": "twilio",
          "whatsapp_params": {
              "whatsapp_phone_number_id": "test-value",
              "whatsapp_call_permission_request_template_name": "test-value",
              "whatsapp_call_permission_request_template_language_code": "test-value"
          },
          "name": "test-value",
          "agent_id": "test-value",
          "branch_id": "test-value",
          "environment": "test-value",
          "created_at_unix": 1,
          "scheduled_time_unix": 1,
          "timezone": "test-value",
          "total_calls_dispatched": 1,
          "total_calls_scheduled": 1,
          "total_calls_finished": 1,
          "last_updated_at_unix": 1,
          "status": "pending",
          "retry_count": 1,
          "telephony_call_config": {
              "ringing_timeout_secs": 1,
              "twilio_call_recording_enabled": true,
              "twilio_machine_detection": {
                  "mode": "enable",
                  "actions": [
                      {
                          "action": "hang_up",
                          "answered_by": [
                              "human"
                          ]
                      }
                  ]
              }
          },
          "target_concurrency_limit": 1,
          "agent_name": "test-value",
          "branch_name": "test-value",
          "recipients": [
              {
                  "id": "test-value",
                  "phone_number": "test-value",
                  "whatsapp_user_id": "test-value",
                  "status": "pending",
                  "created_at_unix": 1,
                  "updated_at_unix": 1,
                  "conversation_id": "test-value",
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
                      },
                      "tool_mock_config": {
                          "mocking_strategy": "all",
                          "fallback_strategy": "call_real_tool",
                          "mocked_tool_names": [
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
                      }
                  }
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->batchCalls->get(batchId: 'batch_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/batch-calling/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(204, '');
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->batchCalls->delete(batchId: 'batch_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/batch-calling/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCancelSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "phone_number_id": "test-value",
          "phone_provider": "twilio",
          "whatsapp_params": {
              "whatsapp_phone_number_id": "test-value",
              "whatsapp_call_permission_request_template_name": "test-value",
              "whatsapp_call_permission_request_template_language_code": "test-value"
          },
          "name": "test-value",
          "agent_id": "test-value",
          "branch_id": "test-value",
          "environment": "test-value",
          "created_at_unix": 1,
          "scheduled_time_unix": 1,
          "timezone": "test-value",
          "total_calls_dispatched": 1,
          "total_calls_scheduled": 1,
          "total_calls_finished": 1,
          "last_updated_at_unix": 1,
          "status": "pending",
          "retry_count": 1,
          "telephony_call_config": {
              "ringing_timeout_secs": 1,
              "twilio_call_recording_enabled": true,
              "twilio_machine_detection": {
                  "mode": "enable",
                  "actions": [
                      {
                          "action": "hang_up",
                          "answered_by": [
                              "human"
                          ]
                      }
                  ]
              }
          },
          "target_concurrency_limit": 1,
          "agent_name": "test-value",
          "branch_name": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->batchCalls->cancel(batchId: 'batch_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/batch-calling/[^/]+/cancel$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testRetrySendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "phone_number_id": "test-value",
          "phone_provider": "twilio",
          "whatsapp_params": {
              "whatsapp_phone_number_id": "test-value",
              "whatsapp_call_permission_request_template_name": "test-value",
              "whatsapp_call_permission_request_template_language_code": "test-value"
          },
          "name": "test-value",
          "agent_id": "test-value",
          "branch_id": "test-value",
          "environment": "test-value",
          "created_at_unix": 1,
          "scheduled_time_unix": 1,
          "timezone": "test-value",
          "total_calls_dispatched": 1,
          "total_calls_scheduled": 1,
          "total_calls_finished": 1,
          "last_updated_at_unix": 1,
          "status": "pending",
          "retry_count": 1,
          "telephony_call_config": {
              "ringing_timeout_secs": 1,
              "twilio_call_recording_enabled": true,
              "twilio_machine_detection": {
                  "mode": "enable",
                  "actions": [
                      {
                          "action": "hang_up",
                          "answered_by": [
                              "human"
                          ]
                      }
                  ]
              }
          },
          "target_concurrency_limit": 1,
          "agent_name": "test-value",
          "branch_name": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->batchCalls->retry(batchId: 'batch_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/batch-calling/[^/]+/retry$#',
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

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\OutboundCampaigns;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class OutboundCampaignsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "campaigns": [
              {
                  "campaign_id": "test-value",
                  "call_name": "test-value",
                  "agent_id": "test-value",
                  "channel_config": {
                      "channel": "phone",
                      "agent_phone_number_id": "test-value",
                      "mode_config": {
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
                          },
                          "mode": "voice"
                      }
                  },
                  "status": "active",
                  "policy": {
                      "timezone": "test-value",
                      "retry": {
                          "retry_delay_seconds": 1,
                          "max_short_retries": 0,
                          "max_total_calls": 1,
                          "max_callbacks": 0,
                          "max_redirects": 0,
                          "interval_placement": "start",
                          "rotate_step_seconds": 1,
                          "max_consecutive_failures_per_number": 1
                      },
                      "calling_periods": [
                          {
                              "weekdays": [
                                  1
                              ],
                              "intervals": [
                                  {
                                      "start": "test-value",
                                      "end": "test-value"
                                  }
                              ]
                          }
                      ],
                      "date_overrides": [
                          {
                              "start_date": "test-value",
                              "end_date": "test-value",
                              "intervals": [
                                  {
                                      "start": "test-value",
                                      "end": "test-value"
                                  }
                              ],
                              "name": "test-value"
                          }
                      ],
                      "data_collection": {
                          "callback_time": "test-value",
                          "redirect_phone_number": "test-value",
                          "stop": "test-value",
                          "mappings": {
                              "key": "test-value"
                          }
                      },
                      "followup_context": {
                          "call_type": true,
                          "previous_conversation_id": true,
                          "previous_summary": true,
                          "previous_transcript": true
                      }
                  },
                  "variant": "simple",
                  "source": "ui",
                  "created_at_unix": 1,
                  "scheduled_time_unix": 1,
                  "updated_at_unix": 1,
                  "branch_id": "test-value",
                  "environment": "test-value",
                  "target_concurrency_limit": 1,
                  "channel": "phone",
                  "mode": "voice",
                  "counts": {
                      "leads": 1,
                      "terminal_leads": 1,
                      "open_attention": 1,
                      "delivery": {
                          "sent": 1,
                          "delivered": 1,
                          "read": 1,
                          "replied": 1,
                          "failed": 1
                      }
                  },
                  "agent_name": "test-value"
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $channel = \ElevenLabs\Types\OutboundChannel::Phone;
    $mode = \ElevenLabs\Agents\OutboundCampaigns\Types\ListOutboundCampaignsRequestMode::Voice;
    $sdk->agents->outboundCampaigns->list(
      request: new \ElevenLabs\Agents\OutboundCampaigns\Requests\ListOutboundCampaignsRequest([
        'pageSize' => 100,
        'status' => [],
        'agentId' => 'agent_id',
        'channel' => $channel->value,
        'mode' => $mode->value,
        'search' => 'search',
        'cursor' => 'cursor'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/campaigns$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testPauseAllSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "paused_campaign_ids": [
              "test-value"
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->outboundCampaigns->pauseAll();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/campaigns/pause-all$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testStopAllSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "stopped_campaign_ids": [
              "test-value"
          ],
          "stopping_campaign_ids": [
              "test-value"
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->outboundCampaigns->stopAll();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/campaigns/stop-all$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "campaign": {
              "campaign_id": "test-value",
              "call_name": "test-value",
              "agent_id": "test-value",
              "channel_config": {
                  "channel": "phone",
                  "agent_phone_number_id": "test-value",
                  "mode_config": {
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
                      },
                      "mode": "voice"
                  }
              },
              "status": "active",
              "policy": {
                  "timezone": "test-value",
                  "retry": {
                      "retry_delay_seconds": 1,
                      "max_short_retries": 0,
                      "max_total_calls": 1,
                      "max_callbacks": 0,
                      "max_redirects": 0,
                      "interval_placement": "start",
                      "rotate_step_seconds": 1,
                      "max_consecutive_failures_per_number": 1
                  },
                  "calling_periods": [
                      {
                          "weekdays": [
                              1
                          ],
                          "intervals": [
                              {
                                  "start": "test-value",
                                  "end": "test-value"
                              }
                          ]
                      }
                  ],
                  "date_overrides": [
                      {
                          "start_date": "test-value",
                          "end_date": "test-value",
                          "intervals": [
                              {
                                  "start": "test-value",
                                  "end": "test-value"
                              }
                          ],
                          "name": "test-value"
                      }
                  ],
                  "data_collection": {
                      "callback_time": "test-value",
                      "redirect_phone_number": "test-value",
                      "stop": "test-value",
                      "mappings": {
                          "key": "test-value"
                      }
                  },
                  "followup_context": {
                      "call_type": true,
                      "previous_conversation_id": true,
                      "previous_summary": true,
                      "previous_transcript": true
                  }
              },
              "variant": "simple",
              "source": "ui",
              "created_at_unix": 1,
              "scheduled_time_unix": 1,
              "updated_at_unix": 1,
              "branch_id": "test-value",
              "environment": "test-value",
              "target_concurrency_limit": 1,
              "channel": "phone",
              "mode": "voice",
              "counts": {
                  "leads": 1,
                  "terminal_leads": 1,
                  "open_attention": 1,
                  "delivery": {
                      "sent": 1,
                      "delivered": 1,
                      "read": 1,
                      "replied": 1,
                      "failed": 1
                  }
              },
              "agent_name": "test-value"
          },
          "created": true,
          "within_calling_window": true
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

    $submitCampaignRecipient = new \ElevenLabs\Types\SubmitCampaignRecipient([
      'phoneNumber' => 'phone_number',
      'phoneNumbers' => [],
      'whatsappUserId' => 'whatsapp_user_id',
      'id' => 'id',
      'timezoneOverride' => 'timezone_override',
      'conversationInitiationClientData' => $conversationInitiationClientDataRequestInput
    ]);

    $intervalPlacement = \ElevenLabs\Types\IntervalPlacement::Start->value;

    $retryPolicy = new \ElevenLabs\Types\RetryPolicy([
      'retryDelaySeconds' => 600,
      'maxShortRetries' => 1,
      'maxTotalCalls' => 6,
      'maxCallbacks' => 2,
      'maxRedirects' => 2,
      'intervalPlacement' => $intervalPlacement,
      'rotateStepSeconds' => 900,
      'maxConsecutiveFailuresPerNumber' => 9
    ]);

    $callingIntervalPolicy = new \ElevenLabs\Types\CallingIntervalPolicy([
      'start' => '14:55',
      'end' => '22:06'
    ]);

    $callingPeriod = new \ElevenLabs\Types\CallingPeriod([
      'weekdays' => [2],
      'intervals' => [$callingIntervalPolicy]
    ]);

    $dateOverride = new \ElevenLabs\Types\DateOverride([
      'startDate' => '2023-01-18',
      'endDate' => '2023-05-02',
      'intervals' => [],
      'name' => 'name'
    ]);

    $dataCollectionConfig = new \ElevenLabs\Types\DataCollectionConfig([
      'callbackTime' => 'callback_time',
      'redirectPhoneNumber' => 'redirect_phone_number',
      'stop' => 'stop',
      'mappings' => []
    ]);

    $followupContextPolicy = new \ElevenLabs\Types\FollowupContextPolicy([
      'callType' => true,
      'previousConversationId' => true,
      'previousSummary' => true,
      'previousTranscript' => true
    ]);

    $policyConfigInput = new \ElevenLabs\Types\PolicyConfigInput([
      'timezone' => 'UTC',
      'retry' => $retryPolicy,
      'callingPeriods' => [$callingPeriod],
      'dateOverrides' => [],
      'dataCollection' => $dataCollectionConfig,
      'followupContext' => $followupContextPolicy
    ]);

    $campaignVariant = \ElevenLabs\Types\CampaignVariant::Simple->value;

    $phoneChannelConfigInputChannel =
      \ElevenLabs\Types\PhoneChannelConfigInputChannel::Phone->value;

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

    $phoneVoiceConfigInputMode = \ElevenLabs\Types\PhoneVoiceConfigInputMode::Voice->value;

    $phoneVoiceConfigInput = new \ElevenLabs\Types\PhoneVoiceConfigInput([
      'ringingTimeoutSecs' => 60,
      'twilioCallRecordingEnabled' => false,
      'twilioMachineDetection' => $twilioMachineDetectionConfig,
      'mode' => $phoneVoiceConfigInputMode
    ]);

    $phoneChannelConfigInput = new \ElevenLabs\Types\PhoneChannelConfigInput([
      'channel' => $phoneChannelConfigInputChannel,
      'agentPhoneNumberId' => 'agent_phone_number_id',
      'modeConfig' => $phoneVoiceConfigInput
    ]);
    $submitCampaignRequestChannelConfig = \ElevenLabs\Agents\OutboundCampaigns\Types\SubmitCampaignRequestChannelConfig::phone(
      $phoneChannelConfigInput
    );

    $request = new \ElevenLabs\Agents\OutboundCampaigns\Requests\SubmitCampaignRequest([
      'callName' => 'call_name',
      'agentId' => 'agent_id',
      'recipients' => [$submitCampaignRecipient],
      'scheduledTimeUnix' => 0,
      'timezone' => 'timezone',
      'branchId' => 'branch_id',
      'environment' => 'environment',
      'targetConcurrencyLimit' => 1,
      'idempotencyKey' => 'idempotency_key',
      'policy' => $policyConfigInput,
      'variant' => $campaignVariant,
      'channelConfig' => $submitCampaignRequestChannelConfig
    ]);
    $sdk->agents->outboundCampaigns->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/campaigns/submit$#',
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
          "campaign_id": "test-value",
          "call_name": "test-value",
          "agent_id": "test-value",
          "channel_config": {
              "channel": "phone",
              "agent_phone_number_id": "test-value",
              "mode_config": {
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
                  },
                  "mode": "voice"
              }
          },
          "status": "active",
          "policy": {
              "timezone": "test-value",
              "retry": {
                  "retry_delay_seconds": 1,
                  "max_short_retries": 0,
                  "max_total_calls": 1,
                  "max_callbacks": 0,
                  "max_redirects": 0,
                  "interval_placement": "start",
                  "rotate_step_seconds": 1,
                  "max_consecutive_failures_per_number": 1
              },
              "calling_periods": [
                  {
                      "weekdays": [
                          1
                      ],
                      "intervals": [
                          {
                              "start": "test-value",
                              "end": "test-value"
                          }
                      ]
                  }
              ],
              "date_overrides": [
                  {
                      "start_date": "test-value",
                      "end_date": "test-value",
                      "intervals": [
                          {
                              "start": "test-value",
                              "end": "test-value"
                          }
                      ],
                      "name": "test-value"
                  }
              ],
              "data_collection": {
                  "callback_time": "test-value",
                  "redirect_phone_number": "test-value",
                  "stop": "test-value",
                  "mappings": {
                      "key": "test-value"
                  }
              },
              "followup_context": {
                  "call_type": true,
                  "previous_conversation_id": true,
                  "previous_summary": true,
                  "previous_transcript": true
              }
          },
          "variant": "simple",
          "source": "ui",
          "created_at_unix": 1,
          "scheduled_time_unix": 1,
          "updated_at_unix": 1,
          "branch_id": "test-value",
          "environment": "test-value",
          "target_concurrency_limit": 1,
          "channel": "phone",
          "mode": "voice",
          "counts": {
              "leads": 1,
              "terminal_leads": 1,
              "open_attention": 1,
              "delivery": {
                  "sent": 1,
                  "delivered": 1,
                  "read": 1,
                  "replied": 1,
                  "failed": 1
              }
          },
          "agent_name": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->outboundCampaigns->get(campaignId: 'campaign_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/campaigns/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetProgressSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "leads": {
              "total": 1,
              "uncalled": 1,
              "leads_needing_attention": 1,
              "active": 1,
              "finished": 1,
              "finished_by_disposition": {
                  "key": 1
              }
          },
          "conversations": {
              "scheduled": 1,
              "scheduled_by_type": {
                  "key": 1
              },
              "awaiting_permission": 1,
              "in_progress": 1,
              "awaiting_analysis": 1
          },
          "next_call_time_unix": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->outboundCampaigns->getProgress(campaignId: 'campaign_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/campaigns/[^/]+/progress$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetFollowUpRequestsSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "callbacks": {
              "requested": 1,
              "requested_by_disposition": {
                  "key": 1
              },
              "distinct_leads": 1
          },
          "redirects": {
              "requested": 1,
              "requested_by_disposition": {
                  "key": 1
              },
              "distinct_leads": 1
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->outboundCampaigns->getFollowUpRequests(campaignId: 'campaign_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/campaigns/[^/]+/follow-up-requests$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testPauseSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "campaign_id": "test-value",
          "call_name": "test-value",
          "agent_id": "test-value",
          "channel_config": {
              "channel": "phone",
              "agent_phone_number_id": "test-value",
              "mode_config": {
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
                  },
                  "mode": "voice"
              }
          },
          "status": "active",
          "policy": {
              "timezone": "test-value",
              "retry": {
                  "retry_delay_seconds": 1,
                  "max_short_retries": 0,
                  "max_total_calls": 1,
                  "max_callbacks": 0,
                  "max_redirects": 0,
                  "interval_placement": "start",
                  "rotate_step_seconds": 1,
                  "max_consecutive_failures_per_number": 1
              },
              "calling_periods": [
                  {
                      "weekdays": [
                          1
                      ],
                      "intervals": [
                          {
                              "start": "test-value",
                              "end": "test-value"
                          }
                      ]
                  }
              ],
              "date_overrides": [
                  {
                      "start_date": "test-value",
                      "end_date": "test-value",
                      "intervals": [
                          {
                              "start": "test-value",
                              "end": "test-value"
                          }
                      ],
                      "name": "test-value"
                  }
              ],
              "data_collection": {
                  "callback_time": "test-value",
                  "redirect_phone_number": "test-value",
                  "stop": "test-value",
                  "mappings": {
                      "key": "test-value"
                  }
              },
              "followup_context": {
                  "call_type": true,
                  "previous_conversation_id": true,
                  "previous_summary": true,
                  "previous_transcript": true
              }
          },
          "variant": "simple",
          "source": "ui",
          "created_at_unix": 1,
          "scheduled_time_unix": 1,
          "updated_at_unix": 1,
          "branch_id": "test-value",
          "environment": "test-value",
          "target_concurrency_limit": 1,
          "channel": "phone",
          "mode": "voice",
          "counts": {
              "leads": 1,
              "terminal_leads": 1,
              "open_attention": 1,
              "delivery": {
                  "sent": 1,
                  "delivered": 1,
                  "read": 1,
                  "replied": 1,
                  "failed": 1
              }
          },
          "agent_name": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->outboundCampaigns->pause(campaignId: 'campaign_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/campaigns/[^/]+/pause$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testResumeSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "campaign_id": "test-value",
          "call_name": "test-value",
          "agent_id": "test-value",
          "channel_config": {
              "channel": "phone",
              "agent_phone_number_id": "test-value",
              "mode_config": {
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
                  },
                  "mode": "voice"
              }
          },
          "status": "active",
          "policy": {
              "timezone": "test-value",
              "retry": {
                  "retry_delay_seconds": 1,
                  "max_short_retries": 0,
                  "max_total_calls": 1,
                  "max_callbacks": 0,
                  "max_redirects": 0,
                  "interval_placement": "start",
                  "rotate_step_seconds": 1,
                  "max_consecutive_failures_per_number": 1
              },
              "calling_periods": [
                  {
                      "weekdays": [
                          1
                      ],
                      "intervals": [
                          {
                              "start": "test-value",
                              "end": "test-value"
                          }
                      ]
                  }
              ],
              "date_overrides": [
                  {
                      "start_date": "test-value",
                      "end_date": "test-value",
                      "intervals": [
                          {
                              "start": "test-value",
                              "end": "test-value"
                          }
                      ],
                      "name": "test-value"
                  }
              ],
              "data_collection": {
                  "callback_time": "test-value",
                  "redirect_phone_number": "test-value",
                  "stop": "test-value",
                  "mappings": {
                      "key": "test-value"
                  }
              },
              "followup_context": {
                  "call_type": true,
                  "previous_conversation_id": true,
                  "previous_summary": true,
                  "previous_transcript": true
              }
          },
          "variant": "simple",
          "source": "ui",
          "created_at_unix": 1,
          "scheduled_time_unix": 1,
          "updated_at_unix": 1,
          "branch_id": "test-value",
          "environment": "test-value",
          "target_concurrency_limit": 1,
          "channel": "phone",
          "mode": "voice",
          "counts": {
              "leads": 1,
              "terminal_leads": 1,
              "open_attention": 1,
              "delivery": {
                  "sent": 1,
                  "delivered": 1,
                  "read": 1,
                  "replied": 1,
                  "failed": 1
              }
          },
          "agent_name": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->outboundCampaigns->resume(campaignId: 'campaign_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/campaigns/[^/]+/resume$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testStopSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "campaign_id": "test-value",
          "call_name": "test-value",
          "agent_id": "test-value",
          "channel_config": {
              "channel": "phone",
              "agent_phone_number_id": "test-value",
              "mode_config": {
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
                  },
                  "mode": "voice"
              }
          },
          "status": "active",
          "policy": {
              "timezone": "test-value",
              "retry": {
                  "retry_delay_seconds": 1,
                  "max_short_retries": 0,
                  "max_total_calls": 1,
                  "max_callbacks": 0,
                  "max_redirects": 0,
                  "interval_placement": "start",
                  "rotate_step_seconds": 1,
                  "max_consecutive_failures_per_number": 1
              },
              "calling_periods": [
                  {
                      "weekdays": [
                          1
                      ],
                      "intervals": [
                          {
                              "start": "test-value",
                              "end": "test-value"
                          }
                      ]
                  }
              ],
              "date_overrides": [
                  {
                      "start_date": "test-value",
                      "end_date": "test-value",
                      "intervals": [
                          {
                              "start": "test-value",
                              "end": "test-value"
                          }
                      ],
                      "name": "test-value"
                  }
              ],
              "data_collection": {
                  "callback_time": "test-value",
                  "redirect_phone_number": "test-value",
                  "stop": "test-value",
                  "mappings": {
                      "key": "test-value"
                  }
              },
              "followup_context": {
                  "call_type": true,
                  "previous_conversation_id": true,
                  "previous_summary": true,
                  "previous_transcript": true
              }
          },
          "variant": "simple",
          "source": "ui",
          "created_at_unix": 1,
          "scheduled_time_unix": 1,
          "updated_at_unix": 1,
          "branch_id": "test-value",
          "environment": "test-value",
          "target_concurrency_limit": 1,
          "channel": "phone",
          "mode": "voice",
          "counts": {
              "leads": 1,
              "terminal_leads": 1,
              "open_attention": 1,
              "delivery": {
                  "sent": 1,
                  "delivered": 1,
                  "read": 1,
                  "replied": 1,
                  "failed": 1
              }
          },
          "agent_name": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->outboundCampaigns->stop(campaignId: 'campaign_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/campaigns/[^/]+/stop$#',
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

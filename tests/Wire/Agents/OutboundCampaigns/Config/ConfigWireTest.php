<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\OutboundCampaigns\Config;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ConfigWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "version": 1,
          "config": {
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
                              0
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
              "agent_policies": {
                  "key": {
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
                                  0
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
                  }
              },
              "whatsapp_voice_policy": {
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
                              0
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
              }
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->outboundCampaigns->config->get();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/config$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "version": 1,
          "config": {
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
                              0
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
              "agent_policies": {
                  "key": {
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
                                  0
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
                  }
              },
              "whatsapp_voice_policy": {
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
                              0
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
              }
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $intervalPlacement = \ElevenLabs\Types\IntervalPlacement::Start->value;

    $retryPolicy = new \ElevenLabs\Types\RetryPolicy([
      'retryDelaySeconds' => 600,
      'maxShortRetries' => 1,
      'maxTotalCalls' => 6,
      'maxCallbacks' => 2,
      'maxRedirects' => 2,
      'intervalPlacement' => $intervalPlacement,
      'rotateStepSeconds' => 900,
      'maxConsecutiveFailuresPerNumber' => 22
    ]);

    $callingIntervalPolicy = new \ElevenLabs\Types\CallingIntervalPolicy([
      'start' => '23:54',
      'end' => '24:00'
    ]);

    $callingPeriod = new \ElevenLabs\Types\CallingPeriod([
      'weekdays' => [5],
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

    $agentPolicyOverrideInput = new \ElevenLabs\Types\AgentPolicyOverrideInput([
      'timezone' => 'timezone',
      'retry' => $retryPolicy,
      'callingPeriods' => [$callingPeriod],
      'dateOverrides' => [],
      'dataCollection' => $dataCollectionConfig,
      'followupContext' => $followupContextPolicy
    ]);

    $campaignConfigInput = new \ElevenLabs\Types\CampaignConfigInput([
      'policy' => $policyConfigInput,
      'agentPolicies' => [],
      'whatsappVoicePolicy' => $agentPolicyOverrideInput
    ]);

    $request = new \ElevenLabs\Agents\OutboundCampaigns\Config\Requests\ReplaceWorkspaceConfigRequest(
      [
        'expectedVersion' => 10,
        'config' => $campaignConfigInput
      ]
    );
    $sdk->agents->outboundCampaigns->config->update(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PUT', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/config$#',
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

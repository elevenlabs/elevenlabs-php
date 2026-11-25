<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\Receptionists;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ReceptionistsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      [
          {
              "agent_id": "test-value",
              "config": {
                  "additional_instructions": "test-value",
                  "tone_traits": [
                      "test-value"
                  ],
                  "details_to_collect": [
                      "test-value"
                  ],
                  "llm": "gpt-4o-mini",
                  "reasoning_effort": "none",
                  "disable_rag": true,
                  "background_voice_detection": true,
                  "turn_eagerness": "patient",
                  "voice_id": "test-value",
                  "language": "test-value",
                  "additional_languages": [
                      "test-value"
                  ],
                  "first_message": "test-value",
                  "first_message_mode": "interruptible",
                  "enable_end_call_tool": true,
                  "enable_skip_turn_tool": true,
                  "enable_play_keypad_touch_tone_tool": true,
                  "agent_rules": [
                      {
                          "title": "test-value",
                          "description": "test-value",
                          "priority": "strict",
                          "id": "test-value",
                          "created_at_unix": 1
                      }
                  ],
                  "transfer_rules": [
                      {
                          "label": "test-value",
                          "phone_number": "test-value",
                          "condition": "test-value",
                          "post_dial_digits": "test-value",
                          "id": "test-value",
                          "created_at_unix": 1
                      }
                  ],
                  "hide_caller_number_on_transfers": true,
                  "record_after_transfers": true,
                  "procedures": [
                      {
                          "name": "test-value",
                          "trigger": "test-value",
                          "body": "test-value",
                          "id": "test-value",
                          "created_at_unix": 1,
                          "source_key": "test-value"
                      }
                  ],
                  "enable_secure_mode": true,
                  "enable_spam_protection": true
              },
              "deactivated_at_unix": 1,
              "deactivation_reason": "tier_downgrade",
              "name": "test-value",
              "agent_exists": true,
              "is_transfer_allowed": true,
              "widget": {
                  "orb_color_1": "test-value",
                  "orb_color_2": "test-value",
                  "variant": "tiny",
                  "placement": "top-left",
                  "dismissible": true,
                  "main_label": "test-value",
                  "start_call": "test-value"
              },
              "is_active": true
          }
      ]
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->receptionists->list(
      request: new \ElevenLabs\Reception\Receptionists\Requests\ListReceptionistsRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/customer-facing-agents$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agent_id": "test-value",
          "config": {
              "additional_instructions": "test-value",
              "tone_traits": [
                  "test-value"
              ],
              "details_to_collect": [
                  "test-value"
              ],
              "llm": "gpt-4o-mini",
              "reasoning_effort": "none",
              "disable_rag": true,
              "background_voice_detection": true,
              "turn_eagerness": "patient",
              "voice_id": "test-value",
              "language": "test-value",
              "additional_languages": [
                  "test-value"
              ],
              "first_message": "test-value",
              "first_message_mode": "interruptible",
              "enable_end_call_tool": true,
              "enable_skip_turn_tool": true,
              "enable_play_keypad_touch_tone_tool": true,
              "agent_rules": [
                  {
                      "title": "test-value",
                      "description": "test-value",
                      "priority": "strict",
                      "id": "test-value",
                      "created_at_unix": 1
                  }
              ],
              "transfer_rules": [
                  {
                      "label": "test-value",
                      "phone_number": "test-value",
                      "condition": "test-value",
                      "post_dial_digits": "test-value",
                      "id": "test-value",
                      "created_at_unix": 1
                  }
              ],
              "hide_caller_number_on_transfers": true,
              "record_after_transfers": true,
              "procedures": [
                  {
                      "name": "test-value",
                      "trigger": "test-value",
                      "body": "test-value",
                      "id": "test-value",
                      "created_at_unix": 1,
                      "source_key": "test-value"
                  }
              ],
              "enable_secure_mode": true,
              "enable_spam_protection": true
          },
          "deactivated_at_unix": 1,
          "deactivation_reason": "tier_downgrade",
          "name": "test-value",
          "agent_exists": true,
          "is_transfer_allowed": true,
          "widget": {
              "orb_color_1": "test-value",
              "orb_color_2": "test-value",
              "variant": "tiny",
              "placement": "top-left",
              "dismissible": true,
              "main_label": "test-value",
              "start_call": "test-value"
          },
          "is_active": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $llm = \ElevenLabs\Types\Llm::Gpt4OMini->value;

    $llmReasoningEffort = \ElevenLabs\Types\LlmReasoningEffort::None->value;

    $receptionTurnEagerness = \ElevenLabs\Types\ReceptionTurnEagerness::Patient->value;

    $firstMessageMode = \ElevenLabs\Types\FirstMessageMode::Interruptible->value;

    $receptionCustomerFacingConfigPatch = new \ElevenLabs\Types\ReceptionCustomerFacingConfigPatch([
      'additionalInstructions' => 'nostrud mol',
      'toneTraits' => [],
      'detailsToCollect' => [],
      'llm' => $llm,
      'reasoningEffort' => $llmReasoningEffort,
      'disableRag' => false,
      'backgroundVoiceDetection' => false,
      'turnEagerness' => $receptionTurnEagerness,
      'voiceId' => '21m00Tcm4TlvDq8ikWAM',
      'language' => 'cupidatat e',
      'additionalLanguages' => [],
      'firstMessage' => 'Hi, thanks for calling Bloom Salon! How can I help you today?',
      'firstMessageMode' => $firstMessageMode,
      'enableEndCallTool' => true,
      'enableSkipTurnTool' => false,
      'enablePlayKeypadTouchToneTool' => true,
      'hideCallerNumberOnTransfers' => false,
      'recordAfterTransfers' => false,
      'enableSecureMode' => true,
      'enableSpamProtection' => true
    ]);

    $receptionWidgetAppearanceVariant =
      \ElevenLabs\Types\ReceptionWidgetAppearanceVariant::Tiny->value;

    $receptionWidgetAppearancePlacement =
      \ElevenLabs\Types\ReceptionWidgetAppearancePlacement::TopLeft->value;

    $receptionWidgetAppearance = new \ElevenLabs\Types\ReceptionWidgetAppearance([
      'orbColor1' => '#2792dc',
      'orbColor2' => '#9ce6e6',
      'variant' => $receptionWidgetAppearanceVariant,
      'placement' => $receptionWidgetAppearancePlacement,
      'dismissible' => true,
      'mainLabel' => 'main_label',
      'startCall' => 'start_call'
    ]);

    $request = new \ElevenLabs\Reception\Receptionists\Requests\ReceptionUpdateCustomerFacingAgentRequest(
      [
        'xiWorkspaceId' => 'xi-workspace-id',
        'config' => $receptionCustomerFacingConfigPatch,
        'name' => 'name',
        'widget' => $receptionWidgetAppearance
      ]
    );
    $sdk->reception->receptionists->update(
      request: $request,
      agentId: 'agent_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/customer-facing-agents/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testActivateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agent_id": "test-value",
          "config": {
              "additional_instructions": "test-value",
              "tone_traits": [
                  "test-value"
              ],
              "details_to_collect": [
                  "test-value"
              ],
              "llm": "gpt-4o-mini",
              "reasoning_effort": "none",
              "disable_rag": true,
              "background_voice_detection": true,
              "turn_eagerness": "patient",
              "voice_id": "test-value",
              "language": "test-value",
              "additional_languages": [
                  "test-value"
              ],
              "first_message": "test-value",
              "first_message_mode": "interruptible",
              "enable_end_call_tool": true,
              "enable_skip_turn_tool": true,
              "enable_play_keypad_touch_tone_tool": true,
              "agent_rules": [
                  {
                      "title": "test-value",
                      "description": "test-value",
                      "priority": "strict",
                      "id": "test-value",
                      "created_at_unix": 1
                  }
              ],
              "transfer_rules": [
                  {
                      "label": "test-value",
                      "phone_number": "test-value",
                      "condition": "test-value",
                      "post_dial_digits": "test-value",
                      "id": "test-value",
                      "created_at_unix": 1
                  }
              ],
              "hide_caller_number_on_transfers": true,
              "record_after_transfers": true,
              "procedures": [
                  {
                      "name": "test-value",
                      "trigger": "test-value",
                      "body": "test-value",
                      "id": "test-value",
                      "created_at_unix": 1,
                      "source_key": "test-value"
                  }
              ],
              "enable_secure_mode": true,
              "enable_spam_protection": true
          },
          "deactivated_at_unix": 1,
          "deactivation_reason": "tier_downgrade",
          "name": "test-value",
          "agent_exists": true,
          "is_transfer_allowed": true,
          "widget": {
              "orb_color_1": "test-value",
              "orb_color_2": "test-value",
              "variant": "tiny",
              "placement": "top-left",
              "dismissible": true,
              "main_label": "test-value",
              "start_call": "test-value"
          },
          "is_active": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->receptionists->activate(
      request: new \ElevenLabs\Reception\Receptionists\Requests\ActivateReceptionistsRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ]),
      agentId: 'agent_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/customer-facing-agents/[^/]+/activate$#',
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

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Realtime;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class RealtimeWireTest extends TestCase
{
  public function testListConversationGroupsSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "conversation_groups": [
              {
                  "id": "test-value",
                  "title": "test-value",
                  "description": "test-value",
                  "access_info": {
                      "is_creator": true,
                      "creator_name": "test-value",
                      "creator_email": "test-value",
                      "role": "admin",
                      "anonymous_access_level_override": "admin",
                      "access_source": "creator"
                  },
                  "sharing": {
                      "people_count": 1,
                      "shared_with_everyone": true,
                      "everyone_role": "admin"
                  },
                  "created_at_unix_secs": 1
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->realtime->listConversationGroups(
      request: new \ElevenLabs\Agents\Realtime\Requests\ListConversationGroupsRealtimeRequest([
        'pageSize' => 100,
        'search' => 'search',
        'cursor' => 'cursor'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/realtime/conversation-groups$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateConversationGroupSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "title": "test-value",
          "description": "test-value",
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          },
          "sharing": {
              "people_count": 1,
              "shared_with_everyone": true,
              "everyone_role": "admin"
          },
          "created_at_unix_secs": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\Realtime\Requests\CreateRealtimeConversationGroupRequestModel(
      [
        'title' => 'title',
        'description' => 'description'
      ]
    );
    $sdk->agents->realtime->createConversationGroup(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/realtime/conversation-groups$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testGetConversationGroupSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "title": "test-value",
          "description": "test-value",
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          },
          "sharing": {
              "people_count": 1,
              "shared_with_everyone": true,
              "everyone_role": "admin"
          },
          "created_at_unix_secs": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->realtime->getConversationGroup(conversationGroupId: 'conversation_group_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/realtime/conversation-groups/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateConversationGroupSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "title": "test-value",
          "description": "test-value",
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          },
          "sharing": {
              "people_count": 1,
              "shared_with_everyone": true,
              "everyone_role": "admin"
          },
          "created_at_unix_secs": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\Realtime\Requests\UpdateRealtimeConversationGroupRequestModel(
      [
        'title' => 'title',
        'description' => 'description'
      ]
    );
    $sdk->agents->realtime->updateConversationGroup(
      request: $request,
      conversationGroupId: 'conversation_group_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/realtime/conversation-groups/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testDeleteConversationGroupSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->realtime->deleteConversationGroup(conversationGroupId: 'conversation_group_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/realtime/conversation-groups/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testSetConversationGroupSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\Realtime\Requests\SetConversationGroupRequestModel([
      'conversationGroupId' => 'conversation_group_id'
    ]);
    $sdk->agents->realtime->setConversationGroup(
      request: $request,
      conversationId: 'conversation_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PUT', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/realtime/conversations/[^/]+/conversation-group$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testClearConversationGroupSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->realtime->clearConversationGroup(conversationId: 'conversation_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/realtime/conversations/[^/]+/conversation-group$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateClientSecretSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "value": "test-value",
          "expires_at": 1,
          "session": {
              "type": "realtime",
              "model": "eleven_realtime_v1_mini",
              "instructions": "test-value",
              "output_modalities": [
                  "test-value"
              ],
              "audio": {
                  "input": {
                      "format": {
                          "type": "audio/pcm",
                          "rate": 1
                      },
                      "transcription": {
                          "language": "test-value"
                      },
                      "turn_detection": {
                          "type": "semantic_vad",
                          "eagerness": "low",
                          "create_response": true,
                          "interrupt_response": true,
                          "threshold": 1,
                          "prefix_padding_ms": 1,
                          "silence_duration_ms": 1,
                          "turn_timeout": 1
                      },
                      "pacing": "realtime"
                  },
                  "output": {
                      "format": {
                          "type": "audio/pcm"
                      },
                      "voice": "test-value"
                  }
              },
              "tools": [
                  {
                      "type": "function",
                      "name": "test-value",
                      "description": "test-value",
                      "parameters": {
                          "key": "test-value"
                      }
                  }
              ],
              "tool_choice": "test-value",
              "temperature": 1,
              "max_response_output_tokens": 1,
              "max_duration_seconds": 60,
              "tracing": "auto"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $openAiSessionConfigInputType = \ElevenLabs\Types\OpenAiSessionConfigInputType::Realtime->value;

    $realtimeModel = \ElevenLabs\Types\RealtimeModel::ElevenRealtimeV1Mini->value;

    $openAiAudioFormat = \ElevenLabs\Types\OpenAiAudioFormat::AudioPcm->value;

    $openAiAudioInputFormat = new \ElevenLabs\Types\OpenAiAudioInputFormat([
      'type' => $openAiAudioFormat,
      'rate' => 24000
    ]);

    $openAiAudioInputTranscription = new \ElevenLabs\Types\OpenAiAudioInputTranscription([
      'language' => 'language'
    ]);

    $turnDetectionType = \ElevenLabs\Types\TurnDetectionType::SemanticVad->value;

    $eagerness = \ElevenLabs\Types\Eagerness::Low->value;

    $openAiTurnDetection = new \ElevenLabs\Types\OpenAiTurnDetection([
      'type' => $turnDetectionType,
      'eagerness' => $eagerness,
      'createResponse' => true,
      'interruptResponse' => true,
      'threshold' => 3.34,
      'prefixPaddingMs' => 8,
      'silenceDurationMs' => 0,
      'turnTimeout' => -1
    ]);

    $audioInputPacing = \ElevenLabs\Types\AudioInputPacing::Realtime->value;

    $openAiAudioInputConfigInput = new \ElevenLabs\Types\OpenAiAudioInputConfigInput([
      'format' => $openAiAudioInputFormat,
      'transcription' => $openAiAudioInputTranscription,
      'turnDetection' => $openAiTurnDetection,
      'pacing' => $audioInputPacing
    ]);

    $openAiAudioOutputFormat = new \ElevenLabs\Types\OpenAiAudioOutputFormat([
      'type' => $openAiAudioFormat
    ]);

    $openAiAudioOutputConfigInput = new \ElevenLabs\Types\OpenAiAudioOutputConfigInput([
      'format' => $openAiAudioOutputFormat,
      'voice' => 'brian'
    ]);

    $openAiAudioConfigInput = new \ElevenLabs\Types\OpenAiAudioConfigInput([
      'input' => $openAiAudioInputConfigInput,
      'output' => $openAiAudioOutputConfigInput
    ]);

    $openAiFunctionToolType = \ElevenLabs\Types\OpenAiFunctionToolType::Function_->value;

    $openAiFunctionTool = new \ElevenLabs\Types\OpenAiFunctionTool([
      'type' => $openAiFunctionToolType,
      'name' => 'name',
      'description' => 'description',
      'parameters' => []
    ]);
    $openAiSessionConfigInputToolsItem = \ElevenLabs\Types\OpenAiSessionConfigInputToolsItem::function(
      $openAiFunctionTool
    );

    $openAiToolChoiceFunctionType =
      \ElevenLabs\Types\OpenAiToolChoiceFunctionType::Function_->value;

    $openAiToolChoiceFunctionInner = new \ElevenLabs\Types\OpenAiToolChoiceFunctionInner([
      'name' => 'name'
    ]);

    $openAiSessionConfigInputToolChoice = new \ElevenLabs\Types\OpenAiToolChoiceFunction([
      'type' => $openAiToolChoiceFunctionType,
      'function' => $openAiToolChoiceFunctionInner
    ]);

    $openAiSessionConfigInputMaxResponseOutputTokens =
      \ElevenLabs\Types\MaxResponseOutputTokens21::Inf->value;

    $openAiSessionConfigInputTurnDetection = new \ElevenLabs\Types\OpenAiTurnDetection([
      'type' => $turnDetectionType,
      'eagerness' => $eagerness,
      'createResponse' => true,
      'interruptResponse' => true,
      'threshold' => 3.34,
      'prefixPaddingMs' => 8,
      'silenceDurationMs' => 0,
      'turnTimeout' => -1
    ]);

    $openAiSessionConfigInputTracing =
      \ElevenLabs\Types\OpenAiSessionConfigInputTracing1::Auto->value;

    $openAiSessionConfigInputTruncation = 'esse enim';

    $openAiSessionConfigInput = new \ElevenLabs\Types\OpenAiSessionConfigInput([
      'type' => $openAiSessionConfigInputType,
      'model' => $realtimeModel,
      'instructions' => 'instructions',
      'outputModalities' => [],
      'audio' => $openAiAudioConfigInput,
      'tools' => [],
      'toolChoice' => $openAiSessionConfigInputToolChoice,
      'temperature' => 0.7,
      'maxResponseOutputTokens' => $openAiSessionConfigInputMaxResponseOutputTokens,
      'maxDurationSeconds' => 600,
      'turnDetection' => $openAiSessionConfigInputTurnDetection,
      'tracing' => $openAiSessionConfigInputTracing,
      'include' => [],
      'parallelToolCalls' => false,
      'reasoning' => [],
      'truncation' => $openAiSessionConfigInputTruncation,
      'prompt' => []
    ]);

    $expiresAfterAnchor = \ElevenLabs\Types\ExpiresAfterAnchor::CreatedAt->value;

    $expiresAfter = new \ElevenLabs\Types\ExpiresAfter([
      'anchor' => $expiresAfterAnchor,
      'seconds' => 9
    ]);

    $request = new \ElevenLabs\Types\CreateClientSecretRequest([
      'session' => $openAiSessionConfigInput,
      'expiresAfter' => $expiresAfter
    ]);
    $sdk->agents->realtime->createClientSecret(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/realtime/client_secrets$#',
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

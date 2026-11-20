<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Settings;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class SettingsWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "conversation_initiation_client_data_webhook": {
              "url": "test-value",
              "request_headers": {
                  "key": "test-value"
              }
          },
          "webhooks": {
              "post_call_webhook_id": "test-value",
              "events": [
                  "transcript"
              ],
              "transcript_format": "json",
              "exclude_transcript": true,
              "send_audio": true
          },
          "can_use_mcp_servers": true,
          "rag_retention_period_days": 30,
          "conversation_embedding_retention_days": 365,
          "default_livekit_stack": "standard"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->settings->get();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/settings$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "conversation_initiation_client_data_webhook": {
              "url": "test-value",
              "request_headers": {
                  "key": "test-value"
              }
          },
          "webhooks": {
              "post_call_webhook_id": "test-value",
              "events": [
                  "transcript"
              ],
              "transcript_format": "json",
              "exclude_transcript": true,
              "send_audio": true
          },
          "can_use_mcp_servers": true,
          "rag_retention_period_days": 30,
          "conversation_embedding_retention_days": 365,
          "default_livekit_stack": "standard"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

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

    $livekitStackType = \ElevenLabs\Types\LivekitStackType::Standard->value;

    $request = new \ElevenLabs\Agents\Settings\Requests\PatchConvAiSettingsRequest([
      'conversationInitiationClientDataWebhook' => $conversationInitiationClientDataWebhook,
      'webhooks' => $convAiWebhooks,
      'canUseMcpServers' => true,
      'ragRetentionPeriodDays' => 10,
      'conversationEmbeddingRetentionDays' => 286,
      'defaultLivekitStack' => $livekitStackType
    ]);
    $sdk->agents->settings->update(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/settings$#',
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

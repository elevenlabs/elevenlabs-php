<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Webhooks;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class WebhooksWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "webhooks": [
              {
                  "name": "test-value",
                  "webhook_id": "test-value",
                  "webhook_url": "test-value",
                  "is_disabled": true,
                  "is_auto_disabled": true,
                  "created_at_unix": 1,
                  "auth_type": "hmac",
                  "usage": [
                      {
                          "usage_type": "ConvAI Agent Settings"
                      }
                  ],
                  "events": [
                      "voice_library_removal_notice"
                  ],
                  "most_recent_failure_error_code": 1,
                  "most_recent_failure_timestamp": 1
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->webhooks->list(
      request: new \ElevenLabs\Webhooks\Requests\ListWebhooksRequest([
        'includeUsages' => true
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/webhooks$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "webhook_id": "test-value",
          "webhook_secret": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $webhookHmacSettingsAuthType = \ElevenLabs\Types\WebhookHmacSettingsAuthType::Hmac->value;

    $webhookHmacSettings = new \ElevenLabs\Types\WebhookHmacSettings([
      'authType' => $webhookHmacSettingsAuthType,
      'name' => 'name',
      'webhookUrl' => 'webhook_url',
      'requestHeaders' => [],
      'logRedactedFields' => []
    ]);

    $request = new \ElevenLabs\Webhooks\Requests\BodyCreateWorkspaceWebhookV1WorkspaceWebhooksPost([
      'settings' => $webhookHmacSettings
    ]);
    $sdk->webhooks->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/webhooks$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "status": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $workspaceWebhookEventType =
      \ElevenLabs\Types\WorkspaceWebhookEventType::VoiceLibraryRemovalNotice->value;

    $request = new \ElevenLabs\Webhooks\Requests\BodyUpdateWorkspaceWebhookV1WorkspaceWebhooksWebhookIdPatch(
      [
        'isDisabled' => true,
        'name' => 'My Callback Webhook',
        'retryEnabled' => false,
        'requestHeaders' => [],
        'events' => [],
        'logRedactedFields' => []
      ]
    );
    $sdk->webhooks->update(request: $request, webhookId: 'G007vmtq9uWYl7SUW9zGS8GZZa1K');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/webhooks/[^/]+$#',
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
      {
          "status": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->webhooks->delete(webhookId: 'G007vmtq9uWYl7SUW9zGS8GZZa1K');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/webhooks/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testTestSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "delivery_id": "test-value",
          "outcome": "delivered",
          "response_code": 1,
          "latency_ms": 1,
          "response_content_type": "test-value",
          "response_body_bytes": 1,
          "failure_origin": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $webhookTypes = \ElevenLabs\Types\WebhookTypes::ProjectConversionStatus->value;

    $request = new \ElevenLabs\Webhooks\Requests\BodySendTestWebhookEventV1WorkspaceWebhooksWebhookIdTestPost(
      [
        'webhookType' => $webhookTypes
      ]
    );
    $sdk->webhooks->test(request: $request, webhookId: 'webhook_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/webhooks/[^/]+/test$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testRedeliverSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "delivery_id": "test-value",
          "outcome": "delivered",
          "response_code": 1,
          "latency_ms": 1,
          "response_content_type": "test-value",
          "response_body_bytes": 1,
          "failure_origin": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->webhooks->redeliver(webhookId: 'webhook_id', deliveryId: 'delivery_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/webhooks/[^/]+/deliveries/[^/]+/redeliver$#',
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

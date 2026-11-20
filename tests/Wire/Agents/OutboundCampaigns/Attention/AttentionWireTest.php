<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\OutboundCampaigns\Attention;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class AttentionWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "attention": [
              {
                  "attention_id": "test-value",
                  "campaign_id": "test-value",
                  "reason": "test-value",
                  "detail": "test-value",
                  "status": "open",
                  "retryable": true,
                  "resolution": "test-value",
                  "created_at_unix": 1,
                  "updated_at_unix": 1
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->outboundCampaigns->attention->list(
      request: new \ElevenLabs\Agents\OutboundCampaigns\Attention\Requests\ListAttentionRequest([
        'campaignId' => 'campaign_id',
        'includeResolved' => false,
        'pageSize' => 100,
        'cursor' => 'cursor'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/attention$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testRetrySendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "attention_id": "test-value",
          "campaign_id": "test-value",
          "reason": "test-value",
          "detail": "test-value",
          "status": "open",
          "retryable": true,
          "resolution": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->outboundCampaigns->attention->retry(attentionId: 'attention_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/attention/[^/]+/retry$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testResolveSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "attention_id": "test-value",
          "campaign_id": "test-value",
          "reason": "test-value",
          "detail": "test-value",
          "status": "open",
          "retryable": true,
          "resolution": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\OutboundCampaigns\Attention\Requests\AttentionResolutionRequest(
      [
        'resolution' => 'resolution'
      ]
    );
    $sdk->agents->outboundCampaigns->attention->resolve(
      request: $request,
      attentionId: 'attention_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/attention/[^/]+/resolve$#',
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

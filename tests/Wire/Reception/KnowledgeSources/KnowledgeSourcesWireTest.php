<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\KnowledgeSources;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class KnowledgeSourcesWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      [
          {
              "source_type": "file",
              "source_url": "test-value",
              "last_scraped_at_unix": 1,
              "original_filename": "test-value",
              "content_type": "test-value",
              "file_size_bytes": 1,
              "status": "processing",
              "error_message": "test-value",
              "failure_reason": "blocked_url",
              "crawl_entire_site": true,
              "scraped_pages_count": 1,
              "content_preview": "test-value",
              "processing_started_at_unix": 1,
              "id": "test-value",
              "created_at_unix": 1,
              "updated_at_unix": 1
          }
      ]
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->knowledgeSources->list(
      request: new \ElevenLabs\Reception\KnowledgeSources\Requests\ListKnowledgeSourcesRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/knowledge-sources$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "source_type": "file",
          "source_url": "test-value",
          "last_scraped_at_unix": 1,
          "original_filename": "test-value",
          "content_type": "test-value",
          "file_size_bytes": 1,
          "status": "processing",
          "error_message": "test-value",
          "failure_reason": "blocked_url",
          "crawl_entire_site": true,
          "scraped_pages_count": 1,
          "content_preview": "test-value",
          "processing_started_at_unix": 1,
          "id": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->knowledgeSources->get(
      request: new \ElevenLabs\Reception\KnowledgeSources\Requests\GetKnowledgeSourcesRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ]),
      sourceId: 'ksource_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/knowledge-sources/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "key": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->knowledgeSources->delete(
      request: new \ElevenLabs\Reception\KnowledgeSources\Requests\DeleteKnowledgeSourcesRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ]),
      sourceId: 'ksource_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/knowledge-sources/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testAddUrlSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "source_type": "file",
          "source_url": "test-value",
          "last_scraped_at_unix": 1,
          "original_filename": "test-value",
          "content_type": "test-value",
          "file_size_bytes": 1,
          "status": "processing",
          "error_message": "test-value",
          "failure_reason": "blocked_url",
          "crawl_entire_site": true,
          "scraped_pages_count": 1,
          "content_preview": "test-value",
          "processing_started_at_unix": 1,
          "id": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Reception\KnowledgeSources\Requests\AddUrlRequest([
      'xiWorkspaceId' => 'xi-workspace-id',
      'url' => 'https://example.com',
      'crawlEntireSite' => true
    ]);
    $sdk->reception->knowledgeSources->addUrl(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/knowledge-sources/urls$#',
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

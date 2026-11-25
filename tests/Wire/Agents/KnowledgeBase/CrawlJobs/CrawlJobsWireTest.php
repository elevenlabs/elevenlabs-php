<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\KnowledgeBase\CrawlJobs;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class CrawlJobsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "crawl_jobs": [
              {
                  "type": "discovery",
                  "seed_url": "test-value",
                  "pattern": "test-value",
                  "exclude_patterns": [
                      "test-value"
                  ],
                  "max_pages": 1,
                  "auto_discover": true,
                  "status": "queued",
                  "pages_identified": 1,
                  "pages_scraped": 1,
                  "pages_skipped": 1,
                  "pages_failed": 1,
                  "root_folder_id": "test-value",
                  "updated_at": 1,
                  "id": "test-value",
                  "created_at": 1
              }
          ],
          "next_cursor": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->knowledgeBase->crawlJobs->list(
      request: new \ElevenLabs\Agents\KnowledgeBase\CrawlJobs\Requests\ListCrawlJobsRequest([
        'includeJobIds' => [],
        'pageSize' => 30,
        'cursor' => 'cursor'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/crawl$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "type": "discovery",
          "root_folder_id": "test-value",
          "status": "test-value",
          "created_at": 1,
          "folder_path": [
              {
                  "id": "test-value"
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\KnowledgeBase\CrawlJobs\Requests\BodyCreateCrawlJobV1ConvaiKnowledgeBaseCrawlPost(
      [
        'url' => 'url',
        'maxDepth' => 3,
        'maxPages' => 1000,
        'pattern' => 'pattern',
        'excludePatterns' => [],
        'sitemapUrls' => [],
        'parentFolderId' => 'parent_folder_id',
        'enableAutoSync' => false,
        'autoRemove' => true,
        'autoDiscover' => false,
        'minimumFrequencyDays' => 99
      ]
    );
    $sdk->agents->knowledgeBase->crawlJobs->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/crawl$#',
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
          "type": "discovery",
          "seed_url": "test-value",
          "pattern": "test-value",
          "exclude_patterns": [
              "test-value"
          ],
          "max_pages": 1,
          "auto_discover": true,
          "status": "queued",
          "pages_identified": 1,
          "pages_scraped": 1,
          "pages_skipped": 1,
          "pages_failed": 1,
          "root_folder_id": "test-value",
          "updated_at": 1,
          "id": "test-value",
          "created_at": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->knowledgeBase->crawlJobs->get(crawlJobId: 'crawl_job_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/crawl/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCancelSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->knowledgeBase->crawlJobs->cancel(crawlJobId: 'crawl_job_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/crawl/[^/]+/cancel$#',
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

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\KnowledgeBase\Documents\Summaries;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class SummariesWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "key": {
              "status": "success",
              "data": {
                  "id": "test-value",
                  "name": "test-value",
                  "metadata": {
                      "created_at_unix_secs": 1,
                      "last_updated_at_unix_secs": 1,
                      "size_bytes": 1
                  },
                  "supported_usages": [
                      "prompt"
                  ],
                  "access_info": {
                      "is_creator": true,
                      "creator_name": "test-value",
                      "creator_email": "test-value",
                      "role": "admin",
                      "anonymous_access_level_override": "admin",
                      "access_source": "creator"
                  },
                  "folder_parent_id": "test-value",
                  "chunking_override": {
                      "max_chunk_size": 1,
                      "overlap_percentage": 1,
                      "custom_separators": [
                          "test-value"
                      ]
                  },
                  "folder_path": [
                      {
                          "id": "test-value"
                      }
                  ],
                  "dependent_agents": [
                      {
                          "referenced_resource_ids": [
                              "test-value"
                          ],
                          "id": "test-value",
                          "name": "test-value",
                          "type": "available",
                          "created_at_unix_secs": 1,
                          "access_level": "admin"
                      }
                  ],
                  "type": "url",
                  "url": "test-value",
                  "auto_sync_info": {
                      "minimum_frequency_days": 1,
                      "auto_remove": true,
                      "consec_failures": 0,
                      "next_refresh_by": 1
                  }
              }
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->knowledgeBase->documents->summaries->get(
      request: new \ElevenLabs\Agents\KnowledgeBase\Documents\Summaries\Requests\GetSummariesRequest(
        [
          'documentIds' => ['document_ids']
        ]
      )
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/summaries$#',
      rawurldecode($sent->getUri()->getPath())
    );
    parse_str($sent->getUri()->getQuery(), $query);
    $this->assertArrayHasKey('document_ids', $query);
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

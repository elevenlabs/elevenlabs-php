<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\KnowledgeBase;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class KnowledgeBaseWireTest extends TestCase
{
  public function testSizeSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "number_of_pages": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->knowledgeBase->size(agentId: 'agent_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agent/[^/]+/knowledge-base/size$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "documents": [
              {
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
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sortDirection = \ElevenLabs\Types\SortDirection::Asc;
    $sortBy = \ElevenLabs\Types\KnowledgeBaseSortBy::Name;
    $sdk->agents->knowledgeBase->list(
      request: new \ElevenLabs\Agents\KnowledgeBase\Requests\ListKnowledgeBaseRequest([
        'pageSize' => 30,
        'search' => 'search',
        'showOnlyOwnedDocuments' => false,
        'createdByUserId' => 'created_by_user_id',
        'types' => [],
        'parentFolderId' => 'parent_folder_id',
        'ancestorFolderId' => 'ancestor_folder_id',
        'foldersFirst' => false,
        'sortDirection' => $sortDirection->value,
        'sortBy' => $sortBy->value,
        'cursor' => 'cursor'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetOrCreateRagIndexesSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "key": {
              "status": "success",
              "data": {
                  "id": "test-value",
                  "model": "e5_mistral_7b_instruct",
                  "status": "new",
                  "progress_percentage": 1,
                  "document_model_index_usage": {
                      "used_bytes": 1
                  }
              }
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $embeddingModelEnum = \ElevenLabs\Types\EmbeddingModelEnum::E5Mistral7BInstruct->value;

    $getOrCreateRagIndexRequestModel = new \ElevenLabs\Types\GetOrCreateRagIndexRequestModel([
      'documentId' => 'document_id',
      'createIfMissing' => false,
      'model' => $embeddingModelEnum
    ]);

    $request = new \ElevenLabs\Agents\KnowledgeBase\Requests\BodyComputeRagIndexesInBatchV1ConvaiKnowledgeBaseRagIndexPost(
      [
        'items' => [$getOrCreateRagIndexRequestModel]
      ]
    );
    $sdk->agents->knowledgeBase->getOrCreateRagIndexes(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/rag-index$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testSearchSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "results": [
              {
                  "document": {
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
                  },
                  "search_snippet": [
                      {
                          "value": "test-value",
                          "is_hit": true
                      }
                  ],
                  "score": 1
              }
          ],
          "next_cursor": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->knowledgeBase->search(
      request: new \ElevenLabs\Agents\KnowledgeBase\Requests\SearchKnowledgeBaseRequest([
        'query' => 'query',
        'pageSize' => 30,
        'types' => [],
        'cursor' => 'cursor'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/search$#',
      rawurldecode($sent->getUri()->getPath())
    );
    parse_str($sent->getUri()->getQuery(), $query);
    $this->assertArrayHasKey('query', $query);
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

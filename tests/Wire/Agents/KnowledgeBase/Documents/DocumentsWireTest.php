<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\KnowledgeBase\Documents;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class DocumentsWireTest extends TestCase
{
  public function testCreateFromUrlSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "name": "test-value",
          "folder_path": [
              {
                  "id": "test-value"
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyCreateUrlDocumentV1ConvaiKnowledgeBaseUrlPost(
      [
        'url' => 'url',
        'name' => 'name',
        'parentFolderId' => 'parent_folder_id',
        'enableAutoSync' => false,
        'autoRemove' => false,
        'minimumFrequencyDays' => 176
      ]
    );
    $sdk->agents->knowledgeBase->documents->createFromUrl(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/url$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testCreateFromTextSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "name": "test-value",
          "folder_path": [
              {
                  "id": "test-value"
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyCreateTextDocumentV1ConvaiKnowledgeBaseTextPost(
      [
        'text' => 'text',
        'name' => 'name',
        'parentFolderId' => 'parent_folder_id'
      ]
    );
    $sdk->agents->knowledgeBase->documents->createFromText(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/text$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testCreateFolderSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "name": "test-value",
          "folder_path": [
              {
                  "id": "test-value"
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyCreateFolderV1ConvaiKnowledgeBaseFolderPost(
      [
        'name' => 'name',
        'parentFolderId' => 'parent_folder_id',
        'enableAutoSync' => false,
        'autoRemove' => false,
        'minimumFrequencyDays' => 32
      ]
    );
    $sdk->agents->knowledgeBase->documents->createFolder(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/folder$#',
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
                  "id": "test-value",
                  "name": "test-value"
              }
          ],
          "type": "url",
          "url": "test-value",
          "extracted_inner_html": "test-value",
          "content_format": "html",
          "auto_sync_info": {
              "minimum_frequency_days": 1,
              "auto_remove": true,
              "consec_failures": 0,
              "next_refresh_by": 1
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->knowledgeBase->documents->get(
      request: new \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\GetDocumentsRequest([
        'agentId' => 'agent_id'
      ]),
      documentationId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
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
                  "id": "test-value",
                  "name": "test-value"
              }
          ],
          "type": "url",
          "url": "test-value",
          "extracted_inner_html": "test-value",
          "content_format": "html",
          "auto_sync_info": {
              "minimum_frequency_days": 1,
              "auto_remove": true,
              "consec_failures": 0,
              "next_refresh_by": 1
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyUpdateDocumentV1ConvaiKnowledgeBaseDocumentationIdPatch(
      [
        'name' => 'name',
        'content' => 'content',
        'enableAutoSync' => true,
        'autoRemove' => true,
        'minimumFrequencyDays' => 11,
        'tightenOnly' => false
      ]
    );
    $sdk->agents->knowledgeBase->documents->update(
      request: $request,
      documentationId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/[^/]+$#',
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
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->knowledgeBase->documents->delete(
      request: new \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\DeleteDocumentsRequest([
        'force' => false
      ]),
      documentationId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetChunkingOverrideSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "chunking_override": {
              "max_chunk_size": 1,
              "overlap_percentage": 1,
              "custom_separators": [
                  "test-value"
              ]
          },
          "effective_chunking_override": {
              "max_chunk_size": 1,
              "overlap_percentage": 1,
              "custom_separators": [
                  "test-value"
              ]
          },
          "inherited_chunking_override": {
              "max_chunk_size": 1,
              "overlap_percentage": 1,
              "custom_separators": [
                  "test-value"
              ]
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->knowledgeBase->documents->getChunkingOverride(
      documentationId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/[^/]+/chunking-override$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateChunkingOverrideSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "chunking_override": {
              "max_chunk_size": 1,
              "overlap_percentage": 1,
              "custom_separators": [
                  "test-value"
              ]
          },
          "reindex_queued": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $chunkingOverrideRequestModel = new \ElevenLabs\Types\ChunkingOverrideRequestModel([
      'maxChunkSize' => 6953058274412879,
      'overlapPercentage' => 4,
      'customSeparators' => []
    ]);

    $request = new \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\UpdateDocumentChunkingOverrideRequestModel(
      [
        'chunkingOverride' => $chunkingOverrideRequestModel
      ]
    );
    $sdk->agents->knowledgeBase->documents->updateChunkingOverride(
      request: $request,
      documentationId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/[^/]+/chunking-override$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testGetAgentsSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agents": [
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
          "branches": [
              {
                  "agent_id": "test-value",
                  "agent_name": "test-value",
                  "branch_id": "test-value",
                  "branch_name": "test-value",
                  "is_main": true
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $dependentType = \ElevenLabs\Types\KnowledgeBaseDependentType::Direct;
    $sdk->agents->knowledgeBase->documents->getAgents(
      request: new \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\GetAgentsDocumentsRequest([
        'dependentType' => $dependentType->value,
        'pageSize' => 30,
        'cursor' => 'cursor'
      ]),
      documentationId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/[^/]+/dependent-agents$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetBulkAgentsSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agents": [
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
          "branches": [
              {
                  "agent_id": "test-value",
                  "agent_name": "test-value",
                  "branch_id": "test-value",
                  "branch_name": "test-value",
                  "is_main": true
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $dependentType = \ElevenLabs\Types\KnowledgeBaseDependentType::Direct;

    $request = new \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyGetDependentAgentsForMultipleDocumentsV1ConvaiKnowledgeBaseDependentAgentsPost(
      [
        'dependentType' => $dependentType->value,
        'pageSize' => 30,
        'cursor' => 'cursor',
        'documentIds' => ['document_ids']
      ]
    );
    $sdk->agents->knowledgeBase->documents->getBulkAgents(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/dependent-agents$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testGetSourceFileUrlSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "signed_url": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->knowledgeBase->documents->getSourceFileUrl(
      documentationId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/[^/]+/source-file-url$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testMoveSendsWireRequest(): void
  {
    $transport = $this->transport(200, '');
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyMoveEntityToFolderV1ConvaiKnowledgeBaseDocumentIdMovePost(
      [
        'moveTo' => 'move_to'
      ]
    );
    $sdk->agents->knowledgeBase->documents->move(
      request: $request,
      documentId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/[^/]+/move$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testBulkMoveSendsWireRequest(): void
  {
    $transport = $this->transport(200, '');
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyBulkMoveEntitiesToFolderV1ConvaiKnowledgeBaseBulkMovePost(
      [
        'documentIds' => ['document_ids'],
        'moveTo' => 'move_to'
      ]
    );
    $sdk->agents->knowledgeBase->documents->bulkMove(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/bulk-move$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testBulkDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "key": {
              "status": "success",
              "data": {
                  "id": "test-value"
              }
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\KnowledgeBase\Documents\Requests\BodyBulkDeleteKnowledgeBaseDocumentsV1ConvaiKnowledgeBaseBulkDeletePost(
      [
        'documentIds' => ['document_ids'],
        'force' => false
      ]
    );
    $sdk->agents->knowledgeBase->documents->bulkDelete(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/bulk-delete$#',
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

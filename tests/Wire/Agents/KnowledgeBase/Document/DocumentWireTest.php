<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\KnowledgeBase\Document;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class DocumentWireTest extends TestCase
{
  public function testRefreshSendsWireRequest(): void
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
    $sdk->agents->knowledgeBase->document->refresh(documentationId: '21m00Tcm4TlvDq8ikWAM');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/[^/]+/refresh$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testComputeRagIndexSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "model": "e5_mistral_7b_instruct",
          "status": "new",
          "progress_percentage": 1,
          "document_model_index_usage": {
              "used_bytes": 1
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $embeddingModelEnum = \ElevenLabs\Types\EmbeddingModelEnum::E5Mistral7BInstruct->value;

    $request = new \ElevenLabs\Agents\KnowledgeBase\Document\Requests\RagIndexRequestModel([
      'model' => $embeddingModelEnum
    ]);
    $sdk->agents->knowledgeBase->document->computeRagIndex(
      request: $request,
      documentationId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/[^/]+/rag-index$#',
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

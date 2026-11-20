<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\KnowledgeBase\Documents\Chunk;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ChunkWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "name": "test-value",
          "content": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $embeddingModel = \ElevenLabs\Types\EmbeddingModelEnum::E5Mistral7BInstruct;
    $sdk->agents->knowledgeBase->documents->chunk->get(
      request: new \ElevenLabs\Agents\KnowledgeBase\Documents\Chunk\Requests\GetChunkRequest([
        'embeddingModel' => $embeddingModel->value
      ]),
      documentationId: '21m00Tcm4TlvDq8ikWAM',
      chunkId: '1'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/[^/]+/chunk/[^/]+$#',
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

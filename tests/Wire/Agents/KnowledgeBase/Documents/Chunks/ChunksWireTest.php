<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\KnowledgeBase\Documents\Chunks;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ChunksWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "chunks": [
              {
                  "id": "test-value",
                  "name": "test-value",
                  "content": "test-value"
              }
          ],
          "next_cursor": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $embeddingModel = \ElevenLabs\Types\EmbeddingModelEnum::E5Mistral7BInstruct;
    $sdk->agents->knowledgeBase->documents->chunks->list(
      request: new \ElevenLabs\Agents\KnowledgeBase\Documents\Chunks\Requests\ListChunksRequest([
        'embeddingModel' => $embeddingModel->value,
        'pageSize' => 30,
        'cursor' => 'cursor'
      ]),
      documentationId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/[^/]+/chunks$#',
      rawurldecode($sent->getUri()->getPath())
    );
    parse_str($sent->getUri()->getQuery(), $query);
    $this->assertArrayHasKey('embedding_model', $query);
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

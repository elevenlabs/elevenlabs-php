<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Dubbing;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class DubbingWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "dubs": [
              {
                  "dubbing_id": "test-value",
                  "name": "test-value",
                  "status": "test-value",
                  "source_language": "test-value",
                  "target_languages": [
                      "test-value"
                  ],
                  "editable": true,
                  "created_at": "2023-01-01T12:34:56Z",
                  "media_metadata": {
                      "content_type": "test-value",
                      "duration": 1
                  },
                  "error": "test-value"
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $dubbingStatus = \ElevenLabs\Dubbing\Types\ListDubbingRequestDubbingStatus::Dubbing;
    $filterByCreator = \ElevenLabs\Dubbing\Types\ListDubbingRequestFilterByCreator::Personal;
    $orderBy = \ElevenLabs\Dubbing\Types\ListDubbingRequestOrderBy::CreatedAt;
    $orderDirection = \ElevenLabs\Dubbing\Types\ListDubbingRequestOrderDirection::Descending;
    $sdk->dubbing->list(
      request: new \ElevenLabs\Dubbing\Requests\ListDubbingRequest([
        'cursor' => 'cursor',
        'pageSize' => 100,
        'dubbingStatus' => $dubbingStatus->value,
        'dubbingStatuses' => [],
        'dubbingModels' => [],
        'targetLanguageCodes' => [],
        'creationSources' => [],
        'filterByCreator' => $filterByCreator->value,
        'orderBy' => $orderBy->value,
        'orderDirection' => $orderDirection->value
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "dubbing_id": "test-value",
          "name": "test-value",
          "status": "test-value",
          "source_language": "test-value",
          "target_languages": [
              "test-value"
          ],
          "editable": true,
          "created_at": "2023-01-01T12:34:56Z",
          "media_metadata": {
              "content_type": "test-value",
              "duration": 1
          },
          "error": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->dubbing->get(dubbingId: 'dubbing_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
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
    $sdk->dubbing->delete(dubbingId: 'dubbing_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/[^/]+$#',
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

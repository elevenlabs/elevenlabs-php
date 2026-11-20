<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\AudioIsolation;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class AudioIsolationWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "items": [
              {
                  "id": "test-value",
                  "title": "test-value",
                  "created_at_unix": 1,
                  "format": "test-value",
                  "duration_seconds": 1,
                  "download_url": "test-value",
                  "icon_url": "test-value",
                  "source_video_url": "test-value",
                  "supports_video": true,
                  "processing": true,
                  "video_processing_failed": true,
                  "preview_b64": "test-value"
              }
          ],
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->audioIsolation->list(
      request: new \ElevenLabs\AudioIsolation\Requests\ListAudioIsolationRequest([
        'pageSize' => 100,
        'page' => 1,
        'search' => 'search'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/audio-isolation/history$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(204, '');
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->audioIsolation->delete(historyItemId: 'history_item_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/audio-isolation/history/[^/]+$#',
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

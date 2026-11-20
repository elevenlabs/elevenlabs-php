<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Dubbing\Project;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ProjectWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "projects": [
              {
                  "project_id": "test-value",
                  "status": "queued",
                  "reference": "test-value",
                  "source_language": "test-value",
                  "model_id": "test-value",
                  "media": {
                      "filename": "test-value",
                      "duration_s": 1,
                      "has_video": true,
                      "mime_type": "test-value"
                  },
                  "language_ids": [
                      "test-value"
                  ],
                  "webhook_ids": [
                      "test-value"
                  ],
                  "revision": 1,
                  "error": {
                      "code": "test-value",
                      "message": "test-value",
                      "retryable": true
                  },
                  "warnings": [
                      {
                          "type": "voices_not_permitted",
                          "speaker_ids": [
                              "test-value"
                          ],
                          "message": "test-value"
                      }
                  ],
                  "created_at": "2023-01-01T12:34:56Z",
                  "updated_at": "2023-01-01T12:34:56Z"
              }
          ],
          "next_cursor": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sortDirection = \ElevenLabs\Dubbing\Project\Types\ListProjectRequestSortDirection::Ascending;
    $sdk->dubbing->project->list(
      request: new \ElevenLabs\Dubbing\Project\Requests\ListProjectRequest([
        'cursor' => 'cursor',
        'pageSize' => 20,
        'status' => 'status',
        'sortDirection' => $sortDirection->value
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/project$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "project_id": "test-value",
          "status": "queued",
          "reference": "test-value",
          "source_language": "test-value",
          "model_id": "test-value",
          "media": {
              "filename": "test-value",
              "duration_s": 1,
              "has_video": true,
              "mime_type": "test-value"
          },
          "language_ids": [
              "test-value"
          ],
          "webhook_ids": [
              "test-value"
          ],
          "revision": 1,
          "error": {
              "code": "test-value",
              "message": "test-value",
              "retryable": true
          },
          "warnings": [
              {
                  "type": "voices_not_permitted",
                  "speaker_ids": [
                      "test-value"
                  ],
                  "message": "test-value"
              }
          ],
          "created_at": "2023-01-01T12:34:56Z",
          "updated_at": "2023-01-01T12:34:56Z"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->dubbing->project->get(projectId: 'project_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/project/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(204, '');
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->dubbing->project->delete(projectId: 'project_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/project/[^/]+$#',
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

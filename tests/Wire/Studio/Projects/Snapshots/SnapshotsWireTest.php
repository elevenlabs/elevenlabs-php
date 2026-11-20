<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Studio\Projects\Snapshots;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class SnapshotsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "snapshots": [
              {
                  "project_snapshot_id": "test-value",
                  "project_id": "test-value",
                  "created_at_unix": 1,
                  "name": "test-value",
                  "audio_upload": {
                      "key": "test-value"
                  },
                  "zip_upload": {
                      "key": "test-value"
                  }
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->studio->projects->snapshots->list(projectId: '21m00Tcm4TlvDq8ikWAM');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/studio/projects/[^/]+/snapshots$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "project_snapshot_id": "test-value",
          "project_id": "test-value",
          "created_at_unix": 1,
          "name": "test-value",
          "audio_upload": {
              "key": "test-value"
          },
          "zip_upload": {
              "key": "test-value"
          },
          "character_alignments": [
              {
                  "characters": [
                      "test-value"
                  ],
                  "character_start_times_seconds": [
                      1
                  ],
                  "character_end_times_seconds": [
                      1
                  ]
              }
          ],
          "audio_duration_secs": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->studio->projects->snapshots->get(
      projectId: '21m00Tcm4TlvDq8ikWAM',
      projectSnapshotId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/studio/projects/[^/]+/snapshots/[^/]+$#',
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

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Dubbing\Project\Transcript;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class TranscriptWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "language": "test-value",
          "segments": [
              {
                  "id": "test-value",
                  "text": "test-value",
                  "speaker_id": "test-value",
                  "start_s": 1,
                  "end_s": 1,
                  "external_id": "test-value"
              }
          ],
          "revision": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->dubbing->project->transcript->get(projectId: 'project_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/project/[^/]+/transcript$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSegmentSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "segment": {
              "id": "test-value",
              "text": "test-value",
              "speaker_id": "test-value",
              "start_s": 1,
              "end_s": 1,
              "external_id": "test-value"
          },
          "revision": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Types\DubbingSegmentUpdateRequest([
      'text' => 'text',
      'speakerId' => 'speaker_id',
      'startS' => 9.82,
      'endS' => 9.28
    ]);
    $sdk->dubbing->project->transcript->updateSegment(
      request: $request,
      projectId: 'project_id',
      segmentId: 'segment_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/project/[^/]+/transcript/segment/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testDeleteSegmentSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "revision": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->dubbing->project->transcript->deleteSegment(
      projectId: 'project_id',
      segmentId: 'segment_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/project/[^/]+/transcript/segment/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSegmentsSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "segments": [
              {
                  "id": "test-value",
                  "text": "test-value",
                  "speaker_id": "test-value",
                  "start_s": 1,
                  "end_s": 1,
                  "external_id": "test-value"
              }
          ],
          "revision": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $dubbingSegmentUpdateRequest = new \ElevenLabs\Types\DubbingSegmentUpdateRequest([
      'text' => 'text',
      'speakerId' => 'speaker_id',
      'startS' => 9.82,
      'endS' => 9.28
    ]);

    $request = new \ElevenLabs\Dubbing\Project\Transcript\Requests\DubbingBulkSegmentUpdateRequest([
      'segments' => []
    ]);
    $sdk->dubbing->project->transcript->updateSegments(request: $request, projectId: 'project_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/project/[^/]+/transcript/segments$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testCreateSegmentSendsWireRequest(): void
  {
    $transport = $this->transport(
      201,
      <<<'JSON'
      {
          "segment": {
              "id": "test-value",
              "text": "test-value",
              "speaker_id": "test-value",
              "start_s": 1,
              "end_s": 1,
              "external_id": "test-value"
          },
          "revision": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Dubbing\Project\Transcript\Requests\DubbingSegmentCreateRequest([
      'text' => 'text',
      'speakerId' => 'speaker_id',
      'startS' => 3.17,
      'endS' => 8.6
    ]);
    $sdk->dubbing->project->transcript->createSegment(request: $request, projectId: 'project_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/project/[^/]+/transcript/segment$#',
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

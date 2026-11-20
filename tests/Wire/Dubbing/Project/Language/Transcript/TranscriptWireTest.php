<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Dubbing\Project\Language\Transcript;

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
          "source_language": "test-value",
          "target_language": "test-value",
          "segments": [
              {
                  "id": "test-value",
                  "speaker_id": "test-value",
                  "start_s": 1,
                  "end_s": 1,
                  "source_text": "test-value",
                  "translation": "test-value"
              }
          ],
          "revision": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->dubbing->project->language->transcript->get(
      projectId: 'project_id',
      languageId: 'language_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/project/[^/]+/language/[^/]+/transcript$#',
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
              "speaker_id": "test-value",
              "start_s": 1,
              "end_s": 1,
              "source_text": "test-value",
              "translation": "test-value"
          },
          "revision": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Types\DubbingTargetSegmentUpdateRequest([
      'translation' => 'translation'
    ]);
    $sdk->dubbing->project->language->transcript->updateSegment(
      request: $request,
      projectId: 'project_id',
      languageId: 'language_id',
      segmentId: 'segment_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/project/[^/]+/language/[^/]+/transcript/segment/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
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
                  "speaker_id": "test-value",
                  "start_s": 1,
                  "end_s": 1,
                  "source_text": "test-value",
                  "translation": "test-value"
              }
          ],
          "revision": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $dubbingTargetSegmentUpdateRequest = new \ElevenLabs\Types\DubbingTargetSegmentUpdateRequest([
      'translation' => 'translation'
    ]);

    $request = new \ElevenLabs\Dubbing\Project\Language\Transcript\Requests\DubbingBulkTargetSegmentUpdateRequest(
      [
        'segments' => []
      ]
    );
    $sdk->dubbing->project->language->transcript->updateSegments(
      request: $request,
      projectId: 'project_id',
      languageId: 'language_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/project/[^/]+/language/[^/]+/transcript/segments$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testRegenerateSendsWireRequest(): void
  {
    $transport = $this->transport(
      202,
      <<<'JSON'
      {
          "regenerated_segment_ids": [
              "test-value"
          ],
          "regenerated_seconds": 1,
          "charged_seconds": 1,
          "free_regeneration_seconds_remaining": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->dubbing->project->language->transcript->regenerate(
      projectId: 'project_id',
      languageId: 'language_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/project/[^/]+/language/[^/]+/transcript/regenerate$#',
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

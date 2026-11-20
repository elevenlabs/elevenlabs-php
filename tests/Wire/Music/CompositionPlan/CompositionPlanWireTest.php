<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Music\CompositionPlan;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class CompositionPlanWireTest extends TestCase
{
  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "positive_global_styles": [
              "test-value"
          ],
          "negative_global_styles": [
              "test-value"
          ],
          "sections": [
              {
                  "section_name": "test-value",
                  "positive_local_styles": [
                      "test-value"
                  ],
                  "negative_local_styles": [
                      "test-value"
                  ],
                  "duration_ms": 3000,
                  "lines": [
                      "test-value"
                  ],
                  "source_from": {
                      "song_id": "test-value",
                      "range": {
                          "start_ms": 1,
                          "end_ms": 1
                      },
                      "negative_ranges": [
                          {
                              "start_ms": 1,
                              "end_ms": 1
                          }
                      ]
                  }
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $timeRange = new \ElevenLabs\Types\TimeRange([
      'startMs' => 6,
      'endMs' => 7
    ]);

    $sectionSource = new \ElevenLabs\Types\SectionSource([
      'songId' => 'song_id',
      'range' => $timeRange,
      'negativeRanges' => []
    ]);

    $songSection = new \ElevenLabs\Types\SongSection([
      'sectionName' => 'section_name',
      'positiveLocalStyles' => [],
      'negativeLocalStyles' => [],
      'durationMs' => 3874,
      'lines' => [],
      'sourceFrom' => $sectionSource
    ]);

    $bodyGenerateCompositionPlanV1MusicPlanPostSourceCompositionPlan = new \ElevenLabs\Types\MusicPrompt(
      [
        'positiveGlobalStyles' => [],
        'negativeGlobalStyles' => [],
        'sections' => []
      ]
    );

    $musicModelId = \ElevenLabs\Types\MusicModelId::MusicV1->value;

    $request = new \ElevenLabs\Music\CompositionPlan\Requests\BodyGenerateCompositionPlanV1MusicPlanPost(
      [
        'enableLogging' => true,
        'prompt' => 'prompt',
        'musicLengthMs' => 172352,
        'sourceCompositionPlan' => $bodyGenerateCompositionPlanV1MusicPlanPostSourceCompositionPlan,
        'modelId' => $musicModelId
      ]
    );
    $sdk->music->compositionPlan->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/music/plan$#',
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

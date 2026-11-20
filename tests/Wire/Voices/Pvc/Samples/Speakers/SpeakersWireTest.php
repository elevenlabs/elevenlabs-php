<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Voices\Pvc\Samples\Speakers;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class SpeakersWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "voice_id": "test-value",
          "sample_id": "test-value",
          "status": "not_started",
          "speakers": {
              "key": {
                  "speaker_id": "test-value",
                  "duration_secs": 1,
                  "utterances": [
                      {
                          "start": 1,
                          "end": 1
                      }
                  ]
              }
          },
          "selected_speaker_ids": [
              "test-value"
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->voices->pvc->samples->speakers->get(
      voiceId: '21m00Tcm4TlvDq8ikWAM',
      sampleId: 'VW7YKqPnjY4h39yTbx2L'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/pvc/[^/]+/samples/[^/]+/speakers$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testSeparateSendsWireRequest(): void
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
    $sdk->voices->pvc->samples->speakers->separate(
      voiceId: '21m00Tcm4TlvDq8ikWAM',
      sampleId: 'VW7YKqPnjY4h39yTbx2L'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/pvc/[^/]+/samples/[^/]+/separate-speakers$#',
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

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Voices\Pvc\Samples\Audio;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class AudioWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "audio_base_64": "test-value",
          "voice_id": "test-value",
          "sample_id": "test-value",
          "media_type": "test-value",
          "duration_secs": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->voices->pvc->samples->audio->get(
      request: new \ElevenLabs\Voices\Pvc\Samples\Audio\Requests\GetAudioRequest([
        'removeBackgroundNoise' => true
      ]),
      voiceId: '21m00Tcm4TlvDq8ikWAM',
      sampleId: 'VW7YKqPnjY4h39yTbx2L'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/pvc/[^/]+/samples/[^/]+/audio$#',
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

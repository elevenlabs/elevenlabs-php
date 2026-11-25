<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Voices\Pvc\Samples;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class SamplesWireTest extends TestCase
{
  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "voice_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Voices\Pvc\Samples\Requests\BodyUpdatePvcVoiceSampleV1VoicesPvcVoiceIdSamplesSampleIdPost(
      [
        'removeBackgroundNoise' => true,
        'selectedSpeakerIds' => [],
        'trimStartTime' => 2,
        'trimEndTime' => 4,
        'fileName' => 'file_name'
      ]
    );
    $sdk->voices->pvc->samples->update(
      request: $request,
      voiceId: '21m00Tcm4TlvDq8ikWAM',
      sampleId: 'VW7YKqPnjY4h39yTbx2L'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/pvc/[^/]+/samples/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
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
    $sdk->voices->pvc->samples->delete(
      voiceId: '21m00Tcm4TlvDq8ikWAM',
      sampleId: 'VW7YKqPnjY4h39yTbx2L'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/pvc/[^/]+/samples/[^/]+$#',
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

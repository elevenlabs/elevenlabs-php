<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Voices\Settings;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class SettingsWireTest extends TestCase
{
  public function testGetDefaultSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "stability": 0,
          "use_speaker_boost": true,
          "similarity_boost": 0,
          "style": 1,
          "speed": 1,
          "clone_strength": 0
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->voices->settings->getDefault();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/settings/default$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "stability": 0,
          "use_speaker_boost": true,
          "similarity_boost": 0,
          "style": 1,
          "speed": 1,
          "clone_strength": 0
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->voices->settings->get(voiceId: '21m00Tcm4TlvDq8ikWAM');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/[^/]+/settings$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
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

    $request = new \ElevenLabs\Types\VoiceSettings([
      'stability' => 0.62,
      'useSpeakerBoost' => true,
      'similarityBoost' => 0.18,
      'style' => 2.67,
      'speed' => 5.4,
      'cloneStrength' => 0.53
    ]);
    $sdk->voices->settings->update(request: $request, voiceId: '21m00Tcm4TlvDq8ikWAM');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/[^/]+/settings/edit$#',
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

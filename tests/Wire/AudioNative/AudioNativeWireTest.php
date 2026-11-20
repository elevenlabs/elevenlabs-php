<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\AudioNative;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class AudioNativeWireTest extends TestCase
{
  public function testGetSettingsSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "enabled": true,
          "snapshot_id": "test-value",
          "settings": {
              "title": "test-value",
              "image": "test-value",
              "author": "test-value",
              "small": true,
              "text_color": "test-value",
              "background_color": "test-value",
              "sessionization": 1,
              "audio_path": "test-value",
              "audio_url": "test-value",
              "status": "processing"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->audioNative->getSettings(projectId: '21m00Tcm4TlvDq8ikWAM');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/audio-native/[^/]+/settings$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateContentFromUrlSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "project_id": "test-value",
          "converting": true,
          "publishing": true,
          "html_snippet": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\AudioNative\Requests\BodyUpdateAudioNativeContentFromUrlV1AudioNativeContentPost(
      [
        'url' => 'https://elevenlabs.io/blog/the_first_ai_that_can_laugh/',
        'author' => 'author',
        'title' => 'title'
      ]
    );
    $sdk->audioNative->updateContentFromUrl(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/audio-native/content$#',
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

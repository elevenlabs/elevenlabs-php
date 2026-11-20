<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\AudioEffects;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class AudioEffectsWireTest extends TestCase
{
  public function testGetCatalogSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "filter_presets": [
              {
                  "filter_preset_id": "test-value",
                  "name": "test-value",
                  "description": "test-value"
              }
          ],
          "environments": [
              {
                  "environment_id": "test-value",
                  "name": "test-value",
                  "description": "test-value"
              }
          ],
          "background_noises": [
              {
                  "background_noise_id": "test-value",
                  "name": "test-value",
                  "description": "test-value"
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->audioEffects->getCatalog();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/audio-effects/catalog$#',
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

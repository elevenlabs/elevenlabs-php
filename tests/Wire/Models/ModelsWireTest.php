<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Models;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ModelsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      [
          {
              "model_id": "test-value",
              "name": "test-value",
              "can_be_finetuned": true,
              "can_do_text_to_speech": true,
              "can_do_voice_conversion": true,
              "can_use_style": true,
              "can_use_speaker_boost": true,
              "serves_pro_voices": true,
              "token_cost_factor": 1,
              "description": "test-value",
              "requires_alpha_access": true,
              "max_characters_request_free_user": 1,
              "max_characters_request_subscribed_user": 1,
              "maximum_text_length_per_request": 1,
              "languages": [
                  {
                      "language_id": "test-value",
                      "name": "test-value"
                  }
              ],
              "model_rates": {
                  "character_cost_multiplier": 1,
                  "cost_discount_multiplier": 1
              },
              "concurrency_group": "test-value"
          }
      ]
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->models->list();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/models$#',
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

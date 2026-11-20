<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Llm;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class LlmWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "llms": [
              {
                  "llm": "gpt-4o-mini",
                  "is_checkpoint": true,
                  "max_tokens_limit": 1,
                  "max_context_limit": 1,
                  "supports_image_input": true,
                  "supports_document_input": true,
                  "supports_parallel_tool_calls": true,
                  "available_reasoning_efforts": [
                      "none"
                  ],
                  "available_service_tiers": [
                      "standard"
                  ],
                  "deprecation_info": {
                      "llm": "gpt-4o-mini",
                      "is_deprecated": true,
                      "is_in_warning_period": true,
                      "is_in_fallback_period": true,
                      "fallback_percentage": 1,
                      "provider_deprecation_date": "2023-01-01T12:34:56Z",
                      "replacement_model": "gpt-4o-mini",
                      "deprecation_config": {
                          "warning_start_days": 1,
                          "fallback_start_days": 1,
                          "fallback_complete_days": 1,
                          "fallback_start_percentage": 1,
                          "fallback_complete_percentage": 1
                      }
                  },
                  "regional_processing_surcharge": {
                      "multiplier": 1
                  }
              }
          ],
          "default_deprecation_config": {
              "warning_start_days": 1,
              "fallback_start_days": 1,
              "fallback_complete_days": 1,
              "fallback_start_percentage": 1,
              "fallback_complete_percentage": 1
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->llm->list();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/llm/list$#',
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

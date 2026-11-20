<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\LlmUsage;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class LlmUsageWireTest extends TestCase
{
  public function testCalculateForAgentSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "llm_prices": [
              {
                  "llm": "gpt-4o-mini",
                  "price_per_minute": 1,
                  "price_per_message": 1
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $llmServiceTier = \ElevenLabs\Types\LlmServiceTier::Standard->value;

    $request = new \ElevenLabs\Agents\LlmUsage\Requests\LlmUsageCalculatorRequestModel([
      'promptLength' => 0,
      'numberOfPages' => 4,
      'ragEnabled' => false,
      'serviceTier' => $llmServiceTier
    ]);
    $sdk->agents->llmUsage->calculateForAgent(request: $request, agentId: 'agent_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agent/[^/]+/llm-usage/calculate$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testCalculateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "llm_prices": [
              {
                  "llm": "gpt-4o-mini",
                  "price_per_minute": 1,
                  "price_per_message": 1
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $llmServiceTier = \ElevenLabs\Types\LlmServiceTier::Standard->value;

    $request = new \ElevenLabs\Agents\LlmUsage\Requests\LlmUsageCalculatorPublicRequestModel([
      'promptLength' => 10,
      'numberOfPages' => 10,
      'ragEnabled' => false,
      'serviceTier' => $llmServiceTier
    ]);
    $sdk->agents->llmUsage->calculate(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/llm-usage/calculate$#',
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

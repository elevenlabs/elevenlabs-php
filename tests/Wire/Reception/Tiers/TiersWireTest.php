<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\Tiers;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class TiersWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      [
          {
              "tier_id": "test-value",
              "display_name": "test-value",
              "currency": "USD",
              "tier_economics": {
                  "monthly_price_usd": 1,
                  "annual_price_usd": 1,
                  "included_minutes_per_month": 1,
                  "overage_price_per_minute_usd": 1,
                  "max_phone_numbers": 1,
                  "concurrent_calls": 1,
                  "max_active_locations": 1,
                  "max_customer_facing_agents": 1,
                  "max_team_members": 1,
                  "assistant_daily_messages": 1
              }
          }
      ]
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->tiers->list();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/reseller/tier-ladder$#',
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

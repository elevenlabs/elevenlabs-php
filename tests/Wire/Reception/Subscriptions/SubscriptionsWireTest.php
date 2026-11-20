<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\Subscriptions;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class SubscriptionsWireTest extends TestCase
{
  public function testAssignSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "key": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $assignResellerTierRequestBillingPeriod =
      \ElevenLabs\Reception\Subscriptions\Types\AssignResellerTierRequestBillingPeriod
        ::MonthlyPeriod->value;

    $request = new \ElevenLabs\Reception\Subscriptions\Requests\AssignResellerTierRequest([
      'tierId' => 'tier_id',
      'billingPeriod' => $assignResellerTierRequestBillingPeriod,
      'idempotencyKey' => 'idempotency_key'
    ]);
    $sdk->reception->subscriptions->assign(
      request: $request,
      workspaceId: '3f2c9a7e1b4d4c8e9a6f0b2d5e7c1a93'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/reseller/workspaces/[^/]+/subscription$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testChangeSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "key": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $changeResellerTierRequestBillingPeriod =
      \ElevenLabs\Reception\Subscriptions\Types\ChangeResellerTierRequestBillingPeriod
        ::MonthlyPeriod->value;

    $request = new \ElevenLabs\Reception\Subscriptions\Requests\ChangeResellerTierRequest([
      'tierId' => 'tier_id',
      'billingPeriod' => $changeResellerTierRequestBillingPeriod,
      'idempotencyKey' => 'idempotency_key'
    ]);
    $sdk->reception->subscriptions->change(
      request: $request,
      workspaceId: '3f2c9a7e1b4d4c8e9a6f0b2d5e7c1a93'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/reseller/workspaces/[^/]+/subscription$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testUnassignSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "key": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->subscriptions->unassign(workspaceId: '3f2c9a7e1b4d4c8e9a6f0b2d5e7c1a93');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/reseller/workspaces/[^/]+/subscription$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testRestoreSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "key": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->subscriptions->restore(workspaceId: '3f2c9a7e1b4d4c8e9a6f0b2d5e7c1a93');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/reseller/workspaces/[^/]+/subscription/restore$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCancelPendingDowngradeSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "key": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->subscriptions->cancelPendingDowngrade(
      workspaceId: '3f2c9a7e1b4d4c8e9a6f0b2d5e7c1a93'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/reseller/workspaces/[^/]+/subscription/cancel-downgrade$#',
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

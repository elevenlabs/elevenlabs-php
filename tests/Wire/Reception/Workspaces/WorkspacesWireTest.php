<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\Workspaces;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class WorkspacesWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "workspaces": [
              {
                  "workspace_id": "test-value",
                  "business_name": "test-value",
                  "billing_tier": "test-value",
                  "receptionist_count": 1,
                  "calls_last_30_days": 1,
                  "created_at_unix": 1,
                  "subscription": {
                      "tier_id": "test-value",
                      "billing_period": "monthly_period",
                      "billing_period_end_unix": 1,
                      "cancel_at_unix": 1,
                      "pending_downgrade_tier": "test-value",
                      "pending_downgrade_at_unix": 1
                  },
                  "has_payment_issue": true,
                  "onboarding_completed_at_unix": 1
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->workspaces->list(
      request: new \ElevenLabs\Reception\Workspaces\Requests\ListWorkspacesRequest([
        'cursor' => 'cursor',
        'pageSize' => 50
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/reseller/workspaces$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "workspace_id": "test-value",
          "business_name": "test-value",
          "billing_tier": "test-value",
          "receptionist_count": 1,
          "calls_last_30_days": 1,
          "created_at_unix": 1,
          "subscription": {
              "tier_id": "test-value",
              "billing_period": "monthly_period",
              "billing_period_end_unix": 1,
              "cancel_at_unix": 1,
              "pending_downgrade_tier": "test-value",
              "pending_downgrade_at_unix": 1
          },
          "has_payment_issue": true,
          "onboarding_completed_at_unix": 1,
          "member_results": [
              {
                  "email": "test-value",
                  "outcome": "invited",
                  "error_status": "test-value"
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $receptionVertical = \ElevenLabs\Types\ReceptionVertical::SalonBarbershop->value;

    $provisionResellerWorkspaceSubscriptionBillingPeriod =
      \ElevenLabs\Types\ProvisionResellerWorkspaceSubscriptionBillingPeriod::MonthlyPeriod->value;

    $provisionResellerWorkspaceSubscription = new \ElevenLabs\Types\ProvisionResellerWorkspaceSubscription(
      [
        'tierId' => 'tier_id',
        'billingPeriod' => $provisionResellerWorkspaceSubscriptionBillingPeriod
      ]
    );

    $teamInviteRequestRole = \ElevenLabs\Types\TeamInviteRequestRole::WorkspaceAdmin->value;

    $teamInviteRequest = new \ElevenLabs\Types\TeamInviteRequest([
      'email' => 'sam@example.com',
      'role' => $teamInviteRequestRole
    ]);

    $request = new \ElevenLabs\Reception\Workspaces\Requests\ReceptionProvisionResellerWorkspaceRequest(
      [
        'businessName' => 'business_name',
        'vertical' => $receptionVertical,
        'subscription' => $provisionResellerWorkspaceSubscription,
        'phoneNumber' => 'phone_number',
        'members' => [],
        'completeOnboarding' => true,
        'idempotencyKey' => 'idempotency_key'
      ]
    );
    $sdk->reception->workspaces->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/reseller/workspaces$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testCompleteOnboardingSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "onboarding_completed_at_unix": 1,
          "customer_facing_agent_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->workspaces->completeOnboarding(
      workspaceId: '3f2c9a7e1b4d4c8e9a6f0b2d5e7c1a93'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/reseller/workspaces/[^/]+/complete-onboarding$#',
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

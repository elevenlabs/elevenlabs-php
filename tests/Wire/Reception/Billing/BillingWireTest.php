<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\Billing;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class BillingWireTest extends TestCase
{
  public function testListInvoicesSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "invoices": [
              {
                  "invoice_id": "test-value",
                  "workspace_id": "test-value",
                  "workspace_name": "test-value",
                  "status": "paid",
                  "amount_cents": 1,
                  "currency": "test-value",
                  "created_unix": 1,
                  "paid_unix": 1,
                  "pay_url": "test-value",
                  "pdf_url": "test-value"
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->billing->listInvoices(
      request: new \ElevenLabs\Reception\Billing\Requests\ListInvoicesBillingRequest([
        'cursor' => 'cursor',
        'pageSize' => 25
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/reseller/billing/invoices$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetInvoiceSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "invoice_id": "test-value",
          "workspace_id": "test-value",
          "workspace_name": "test-value",
          "status": "paid",
          "amount_cents": 1,
          "currency": "test-value",
          "created_unix": 1,
          "paid_unix": 1,
          "pay_url": "test-value",
          "pdf_url": "test-value",
          "lines": [
              {
                  "kind": "plan",
                  "description": "test-value",
                  "quantity": 1,
                  "amount_cents": 1,
                  "period_start_unix": 1,
                  "period_end_unix": 1
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->billing->getInvoice(invoiceId: 'in_1QzX8vLkdIwHu7ix3Bv0Wy2d');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/reseller/billing/invoices/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testListUpcomingPaymentsSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "payments": [
              {
                  "workspace_id": "test-value",
                  "workspace_name": "test-value",
                  "subscription": {
                      "tier_id": "test-value",
                      "billing_period": "monthly_period",
                      "billing_period_end_unix": 1,
                      "cancel_at_unix": 1,
                      "pending_downgrade_tier": "test-value",
                      "pending_downgrade_at_unix": 1
                  },
                  "plan_usd": 1,
                  "overage_so_far_usd": 1
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->billing->listUpcomingPayments();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/reseller/billing/upcoming$#',
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

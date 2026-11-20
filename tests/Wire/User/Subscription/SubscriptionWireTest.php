<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\User\Subscription;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class SubscriptionWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "tier": "test-value",
          "character_count": 1,
          "character_limit": 1,
          "max_character_limit_extension": 1,
          "max_credit_limit_extension": 1,
          "can_extend_character_limit": true,
          "allowed_to_extend_character_limit": true,
          "next_character_count_reset_unix": 1,
          "voice_slots_used": 1,
          "professional_voice_slots_used": 1,
          "professional_voice_slots_used_in_workspace": 1,
          "voice_limit": 1,
          "max_voice_add_edits": 1,
          "voice_add_edit_counter": 1,
          "professional_voice_limit": 1,
          "can_extend_voice_limit": true,
          "can_use_instant_voice_cloning": true,
          "can_use_professional_voice_cloning": true,
          "currency": "usd",
          "current_overage": {
              "amount": "test-value",
              "currency": "usd"
          },
          "status": "trialing",
          "billing_period": "monthly_period",
          "character_refresh_period": "monthly_period",
          "next_invoice": {
              "amount_due_cents": 1,
              "subtotal_cents": 1,
              "tax_cents": 1,
              "discount_percent_off": 1,
              "discount_amount_off": 1,
              "discounts": [
                  {
                      "discount_percent_off": 1,
                      "discount_amount_off": 1
                  }
              ],
              "next_payment_attempt_unix": 1,
              "payment_intent_status": "canceled",
              "payment_intent_statusses": [
                  "canceled"
              ]
          },
          "open_invoices": [
              {
                  "amount_due_cents": 1,
                  "subtotal_cents": 1,
                  "tax_cents": 1,
                  "discount_percent_off": 1,
                  "discount_amount_off": 1,
                  "discounts": [
                      {
                          "discount_percent_off": 1,
                          "discount_amount_off": 1
                      }
                  ],
                  "next_payment_attempt_unix": 1,
                  "payment_intent_status": "canceled",
                  "payment_intent_statusses": [
                      "canceled"
                  ]
              }
          ],
          "has_open_invoices": true,
          "cancels_immediately": true,
          "pending_change": {
              "kind": "change",
              "next_tier": "free",
              "next_billing_period": "monthly_period",
              "timestamp_seconds": 1
          },
          "has_used_starter_coupon_on_account": true,
          "has_used_creator_coupon_on_account": true,
          "is_eligible_for_starter_promo": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->user->subscription->get();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/user/subscription$#',
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

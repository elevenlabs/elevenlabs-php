<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\User;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class UserWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "user_id": "test-value",
          "workspace_id": "test-value",
          "subscription": {
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
              "character_refresh_period": "monthly_period"
          },
          "is_new_user": true,
          "can_use_delayed_payment_methods": true,
          "is_onboarding_completed": true,
          "is_onboarding_checklist_completed": true,
          "show_compliance_terms": true,
          "first_name": "test-value",
          "is_api_key_hashed": true,
          "xi_api_key_preview": "test-value",
          "referral_link_code": "test-value",
          "partnerstack_partner_default_link": "test-value",
          "created_at": 1,
          "seat_type": "workspace_admin"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->user->get();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression('#/v1/user$#', rawurldecode($sent->getUri()->getPath()));
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

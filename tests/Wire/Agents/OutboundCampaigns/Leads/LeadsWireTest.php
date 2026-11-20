<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\OutboundCampaigns\Leads;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class LeadsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "leads": [
              {
                  "lead_id": "test-value",
                  "recipient_id": "test-value",
                  "phone_number": "test-value",
                  "phone_numbers": [
                      "test-value"
                  ],
                  "phone_numbers_index": 1,
                  "user_id": "test-value",
                  "attempt_count": 1,
                  "failure_count": 1,
                  "callback_count": 1,
                  "redirect_count": 1,
                  "do_not_call": true,
                  "terminal_disposition": "campaign_ended",
                  "created_at_unix": 1,
                  "updated_at_unix": 1,
                  "dynamic_variables": {
                      "key": "test-value"
                  },
                  "overrides": {
                      "language": "test-value",
                      "first_message": "test-value",
                      "prompt": "test-value",
                      "voice_id": "test-value"
                  },
                  "delivery": {
                      "status": "pending",
                      "stage": "queued",
                      "sent_at_unix": 1,
                      "delivered_at_unix": 1,
                      "read_at_unix": 1,
                      "replied_at_unix": 1,
                      "failed_at_unix": 1,
                      "error_message": "test-value"
                  }
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $status = \ElevenLabs\Agents\OutboundCampaigns\Leads\Types\ListLeadsRequestStatus::InProgress;
    $sdk->agents->outboundCampaigns->leads->list(
      request: new \ElevenLabs\Agents\OutboundCampaigns\Leads\Requests\ListLeadsRequest([
        'pageSize' => 100,
        'search' => 'search',
        'status' => $status->value,
        'disposition' => [],
        'cursor' => 'cursor'
      ]),
      campaignId: 'campaign_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/campaigns/[^/]+/leads$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "lead_id": "test-value",
          "recipient_id": "test-value",
          "phone_number": "test-value",
          "phone_numbers": [
              "test-value"
          ],
          "phone_numbers_index": 1,
          "user_id": "test-value",
          "attempt_count": 1,
          "failure_count": 1,
          "callback_count": 1,
          "redirect_count": 1,
          "do_not_call": true,
          "terminal_disposition": "campaign_ended",
          "created_at_unix": 1,
          "updated_at_unix": 1,
          "dynamic_variables": {
              "key": "test-value"
          },
          "overrides": {
              "language": "test-value",
              "first_message": "test-value",
              "prompt": "test-value",
              "voice_id": "test-value"
          },
          "delivery": {
              "status": "pending",
              "stage": "queued",
              "sent_at_unix": 1,
              "delivered_at_unix": 1,
              "read_at_unix": 1,
              "replied_at_unix": 1,
              "failed_at_unix": 1,
              "error_message": "test-value"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->outboundCampaigns->leads->get(campaignId: 'campaign_id', leadId: 'lead_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/campaigns/[^/]+/leads/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "campaign_id": "test-value",
          "lead_id": "test-value",
          "has_calls_in_flight": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->outboundCampaigns->leads->delete(campaignId: 'campaign_id', leadId: 'lead_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/campaigns/[^/]+/leads/[^/]+$#',
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

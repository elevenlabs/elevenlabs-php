<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\OutboundCampaigns\Calls;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class CallsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "calls": [
              {
                  "intent_id": "test-value",
                  "lead_id": "test-value",
                  "intent_type": "initial",
                  "cold_attempt": 1,
                  "status": "queued",
                  "phone_number": "test-value",
                  "scheduled_time_unix": 1,
                  "conversation_id": "test-value",
                  "outcome": "pending",
                  "call_result": "answered",
                  "outcome_at_unix": 1,
                  "decision_disposition": "completed",
                  "collected_dynamic_variables": {
                      "key": "test-value"
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
    $status = \ElevenLabs\Types\CallStatus::Queued;
    $stage = \ElevenLabs\Agents\OutboundCampaigns\Calls\Types\ListCallsRequestStage::Queued;
    $sdk->agents->outboundCampaigns->calls->list(
      request: new \ElevenLabs\Agents\OutboundCampaigns\Calls\Requests\ListCallsRequest([
        'pageSize' => 100,
        'leadId' => 'lead_id',
        'status' => $status->value,
        'callResult' => [],
        'stage' => $stage->value,
        'cursor' => 'cursor'
      ]),
      campaignId: 'campaign_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/outbound-campaigns/campaigns/[^/]+/calls$#',
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

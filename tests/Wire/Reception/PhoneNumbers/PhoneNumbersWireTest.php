<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\PhoneNumbers;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class PhoneNumbersWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      [
          {
              "phone_number": "test-value",
              "is_byo": true,
              "provider": "twilio",
              "nanp_area_code": 1,
              "customer_facing_agent_id": "test-value",
              "deactivated_at_unix": 1,
              "deactivation_reason": "tier_downgrade",
              "regulatory_status": "held",
              "regulatory_number_type": "local",
              "regulatory_country": "test-value",
              "id": "test-value",
              "created_at_unix": 1,
              "updated_at_unix": 1,
              "is_active": true,
              "accepts_public_calls": true
          }
      ]
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->phoneNumbers->list(
      request: new \ElevenLabs\Reception\PhoneNumbers\Requests\ListPhoneNumbersRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/phone-numbers/assignments$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      201,
      <<<'JSON'
      {
          "phone_number": "test-value",
          "is_byo": true,
          "provider": "twilio",
          "nanp_area_code": 1,
          "customer_facing_agent_id": "test-value",
          "deactivated_at_unix": 1,
          "deactivation_reason": "tier_downgrade",
          "regulatory_status": "held",
          "regulatory_number_type": "local",
          "regulatory_country": "test-value",
          "id": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1,
          "is_active": true,
          "accepts_public_calls": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $applicationNumberType = \ElevenLabs\Types\ApplicationNumberType::Local->value;

    $request = new \ElevenLabs\Reception\PhoneNumbers\Requests\CreatePhoneAssignmentRequest([
      'xiWorkspaceId' => 'xi-workspace-id',
      'customerFacingAgentId' => 'agent_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      'areaCodes' => [],
      'numberType' => $applicationNumberType,
      'idempotencyKey' => 'idempotency_key'
    ]);
    $sdk->reception->phoneNumbers->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/phone-numbers/assignments$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "phone_number": "test-value",
          "is_byo": true,
          "provider": "twilio",
          "nanp_area_code": 1,
          "customer_facing_agent_id": "test-value",
          "deactivated_at_unix": 1,
          "deactivation_reason": "tier_downgrade",
          "regulatory_status": "held",
          "regulatory_number_type": "local",
          "regulatory_country": "test-value",
          "id": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1,
          "is_active": true,
          "accepts_public_calls": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Reception\PhoneNumbers\Requests\ReassignPhoneRequest([
      'xiWorkspaceId' => 'xi-workspace-id',
      'customerFacingAgentId' => 'agent_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    ]);
    $sdk->reception->phoneNumbers->update(
      request: $request,
      phoneAssignmentId: 'phone_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/phone-numbers/assignments/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(204, '');
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->phoneNumbers->delete(
      request: new \ElevenLabs\Reception\PhoneNumbers\Requests\DeletePhoneNumbersRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ]),
      phoneAssignmentId: 'phone_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/phone-numbers/assignments/[^/]+$#',
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

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\WhatsappAccounts;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class WhatsappAccountsWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "business_account_id": "test-value",
          "phone_number_id": "test-value",
          "business_account_name": "test-value",
          "phone_number_name": "test-value",
          "phone_number": "test-value",
          "account_type": "cloud_api",
          "assigned_agent_id": "test-value",
          "enable_messaging": true,
          "enable_audio_message_response": true,
          "enable_typing_indicator": true,
          "assigned_agent_name": "test-value",
          "is_token_expired": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->whatsappAccounts->get(phoneNumberId: 'phone_number_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/whatsapp-accounts/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\WhatsappAccounts\Requests\UpdateWhatsAppAccountRequest([
      'assignedAgentId' => 'assigned_agent_id',
      'enableMessaging' => true,
      'enableAudioMessageResponse' => false,
      'enableTypingIndicator' => true
    ]);
    $sdk->agents->whatsappAccounts->update(request: $request, phoneNumberId: 'phone_number_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/whatsapp-accounts/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->whatsappAccounts->delete(phoneNumberId: 'phone_number_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/whatsapp-accounts/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "items": [
              {
                  "business_account_id": "test-value",
                  "phone_number_id": "test-value",
                  "business_account_name": "test-value",
                  "phone_number_name": "test-value",
                  "phone_number": "test-value",
                  "account_type": "cloud_api",
                  "assigned_agent_id": "test-value",
                  "enable_messaging": true,
                  "enable_audio_message_response": true,
                  "enable_typing_indicator": true,
                  "assigned_agent_name": "test-value",
                  "is_token_expired": true
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->whatsappAccounts->list(
      request: new \ElevenLabs\Agents\WhatsappAccounts\Requests\ListWhatsappAccountsRequest([
        'agentId' => 'agent_id'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/whatsapp-accounts$#',
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

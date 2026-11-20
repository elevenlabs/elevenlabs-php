<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\PhoneNumbers;

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
              "label": "test-value",
              "supports_inbound": true,
              "supports_outbound": true,
              "phone_number_id": "test-value",
              "assigned_agent": {
                  "agent_id": "test-value",
                  "agent_name": "test-value",
                  "environment": "test-value",
                  "branch_id": "test-value"
              },
              "provider": "twilio"
          }
      ]
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $provider = \ElevenLabs\Types\TelephonyProvider::Twilio;
    $sdk->agents->phoneNumbers->list(
      request: new \ElevenLabs\Agents\PhoneNumbers\Requests\ListPhoneNumbersRequest([
        'provider' => $provider->value,
        'agentId' => 'agent_id',
        'branchId' => 'branch_id'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/phone-numbers$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "phone_number_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $createTwilioPhoneNumberRequestProvider =
      \ElevenLabs\Types\CreateTwilioPhoneNumberRequestProvider::Twilio->value;

    $twilioRegionId = \ElevenLabs\Types\TwilioRegionId::Us1->value;

    $twilioEdgeLocation = \ElevenLabs\Types\TwilioEdgeLocation::Ashburn->value;

    $regionConfigRequest = new \ElevenLabs\Types\RegionConfigRequest([
      'regionId' => $twilioRegionId,
      'token' => 'token',
      'edgeLocation' => $twilioEdgeLocation
    ]);

    $request = new \ElevenLabs\Types\CreateTwilioPhoneNumberRequest([
      'phoneNumber' => 'phone_number',
      'label' => 'label',
      'supportsInbound' => true,
      'supportsOutbound' => true,
      'provider' => $createTwilioPhoneNumberRequestProvider,
      'agentId' => 'agent_id',
      'sid' => 'sid',
      'token' => 'token',
      'accountAuthToken' => 'account_auth_token',
      'regionConfig' => $regionConfigRequest,
      'enableSms' => true
    ]);
    $sdk->agents->phoneNumbers->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/phone-numbers$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "phone_number": "test-value",
          "label": "test-value",
          "supports_inbound": true,
          "supports_outbound": true,
          "phone_number_id": "test-value",
          "assigned_agent": {
              "agent_id": "test-value",
              "agent_name": "test-value",
              "environment": "test-value",
              "branch_id": "test-value"
          },
          "provider": "twilio"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->phoneNumbers->get(phoneNumberId: 'TeaqRRdTcIfIu2i7BYfT');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/phone-numbers/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "phone_number": "test-value",
          "label": "test-value",
          "supports_inbound": true,
          "supports_outbound": true,
          "phone_number_id": "test-value",
          "assigned_agent": {
              "agent_id": "test-value",
              "agent_name": "test-value",
              "environment": "test-value",
              "branch_id": "test-value"
          },
          "provider": "twilio"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sipMediaEncryptionEnum = \ElevenLabs\Types\SipMediaEncryptionEnum::Disabled->value;

    $sipTrunkCredentialsRequestModel = new \ElevenLabs\Types\SipTrunkCredentialsRequestModel([
      'username' => 'username',
      'password' => 'password'
    ]);

    $inboundSipTrunkConfigRequestModel = new \ElevenLabs\Types\InboundSipTrunkConfigRequestModel([
      'allowedAddresses' => [],
      'allowedNumbers' => [],
      'mediaEncryption' => $sipMediaEncryptionEnum,
      'credentials' => $sipTrunkCredentialsRequestModel,
      'remoteDomains' => [],
      'attributesToHeaders' => []
    ]);

    $sipTrunkTransportEnum = \ElevenLabs\Types\SipTrunkTransportEnum::Auto->value;

    $mediaCodec = \ElevenLabs\Types\MediaCodec::G7228000->value;

    $outboundSipTrunkConfigRequestModel = new \ElevenLabs\Types\OutboundSipTrunkConfigRequestModel([
      'address' => 'address',
      'transport' => $sipTrunkTransportEnum,
      'mediaEncryption' => $sipMediaEncryptionEnum,
      'headers' => [],
      'attributesToHeaders' => [],
      'credentials' => $sipTrunkCredentialsRequestModel,
      'enabledCodecs' => []
    ]);

    $livekitStackType = \ElevenLabs\Types\LivekitStackType::Standard->value;

    $request = new \ElevenLabs\Agents\PhoneNumbers\Requests\UpdatePhoneNumberRequest([
      'agentId' => 'agent_id',
      'label' => 'label',
      'inboundTrunkConfig' => $inboundSipTrunkConfigRequestModel,
      'outboundTrunkConfig' => $outboundSipTrunkConfigRequestModel,
      'livekitStack' => $livekitStackType,
      'storeSipMessages' => false,
      'environment' => 'environment',
      'branchId' => 'branch_id'
    ]);
    $sdk->agents->phoneNumbers->update(request: $request, phoneNumberId: 'TeaqRRdTcIfIu2i7BYfT');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/phone-numbers/[^/]+$#',
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
    $sdk->agents->phoneNumbers->delete(phoneNumberId: 'TeaqRRdTcIfIu2i7BYfT');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/phone-numbers/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testListV2SendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "phone_numbers": [
              {
                  "phone_number": "test-value",
                  "label": "test-value",
                  "supports_inbound": true,
                  "supports_outbound": true,
                  "phone_number_id": "test-value",
                  "assigned_agent": {
                      "agent_id": "test-value",
                      "agent_name": "test-value",
                      "environment": "test-value",
                      "branch_id": "test-value"
                  },
                  "provider": "twilio"
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $provider = \ElevenLabs\Types\TelephonyProvider::Twilio;
    $sortBy = \ElevenLabs\Types\PhoneNumberSortBy::Label;
    $sortDirection = \ElevenLabs\Types\SortDirection::Asc;
    $sdk->agents->phoneNumbers->listV2(
      request: new \ElevenLabs\Agents\PhoneNumbers\Requests\ListV2PhoneNumbersRequest([
        'pageSize' => 100,
        'search' => 'search',
        'label' => 'label',
        'phoneNumber' => 'phone_number',
        'provider' => $provider->value,
        'supportsOutbound' => true,
        'agentId' => 'agent_id',
        'branchId' => 'branch_id',
        'sortBy' => $sortBy->value,
        'sortDirection' => $sortDirection->value,
        'cursor' => 'cursor'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/v2/phone-numbers$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetSipMessagesSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "sip_messages": [
              {
                  "call_id": "test-value",
                  "phone_numbers": [
                      "test-value"
                  ],
                  "local_address": "test-value",
                  "remote_address": "test-value",
                  "transport": "test-value",
                  "raw_message": "test-value",
                  "error_message": "test-value",
                  "direction": "in",
                  "created_at_unix_micro": 1
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->phoneNumbers->getSipMessages(
      request: new \ElevenLabs\Agents\PhoneNumbers\Requests\GetSipMessagesPhoneNumbersRequest([
        'pageSize' => 20,
        'cursor' => 'cursor'
      ]),
      phoneNumberId: 'TeaqRRdTcIfIu2i7BYfT'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/phone-numbers/[^/]+/sip-messages$#',
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

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Workspace\AuthConnections;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class AuthConnectionsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "auth_connections": [
              {
                  "name": "test-value",
                  "auth_type": "oauth2_client_credentials",
                  "provider": "test-value",
                  "client_id": "test-value",
                  "token_url": "test-value",
                  "scopes": [
                      "test-value"
                  ],
                  "extra_params": {
                      "key": "test-value"
                  },
                  "basic_auth_in_header": true,
                  "id": "test-value",
                  "used_by": {
                      "tools": [
                          {
                              "id": "test-value",
                              "name": "test-value",
                              "type": "available",
                              "created_at_unix_secs": 1,
                              "access_level": "admin"
                          }
                      ],
                      "mcp_servers": [
                          {
                              "id": "test-value",
                              "name": "test-value",
                              "type": "available",
                              "created_at_unix_secs": 1,
                              "access_level": "admin"
                          }
                      ],
                      "integration_connections": [
                          {
                              "id": "test-value",
                              "name": "test-value"
                          }
                      ]
                  },
                  "status": "active",
                  "status_detail": "test-value",
                  "status_updated_at": "test-value",
                  "custom_headers": {
                      "key": "test-value"
                  }
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->workspace->authConnections->list();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/auth-connections$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "name": "test-value",
          "auth_type": "oauth2_client_credentials",
          "provider": "test-value",
          "client_id": "test-value",
          "token_url": "test-value",
          "scopes": [
              "test-value"
          ],
          "extra_params": {
              "key": "test-value"
          },
          "basic_auth_in_header": true,
          "id": "test-value",
          "used_by": {
              "tools": [
                  {
                      "id": "test-value",
                      "name": "test-value",
                      "type": "available",
                      "created_at_unix_secs": 1,
                      "access_level": "admin"
                  }
              ],
              "mcp_servers": [
                  {
                      "id": "test-value",
                      "name": "test-value",
                      "type": "available",
                      "created_at_unix_secs": 1,
                      "access_level": "admin"
                  }
              ],
              "integration_connections": [
                  {
                      "id": "test-value",
                      "name": "test-value"
                  }
              ]
          },
          "status": "active",
          "status_detail": "test-value",
          "status_updated_at": "test-value",
          "custom_headers": {
              "key": "test-value"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $createOAuth2ClientCredsRequestAuthType =
      \ElevenLabs\Types\CreateOAuth2ClientCredsRequestAuthType::Oauth2ClientCredentials->value;

    $request = new \ElevenLabs\Types\CreateOAuth2ClientCredsRequest([
      'name' => 'name',
      'authType' => $createOAuth2ClientCredsRequestAuthType,
      'provider' => 'provider',
      'clientId' => 'client_id',
      'tokenUrl' => 'token_url',
      'scopes' => [],
      'extraParams' => [],
      'basicAuthInHeader' => false,
      'clientSecret' => 'client_secret',
      'customHeaders' => []
    ]);
    $sdk->workspace->authConnections->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/auth-connections$#',
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
          "name": "test-value",
          "auth_type": "oauth2_client_credentials",
          "provider": "test-value",
          "client_id": "test-value",
          "token_url": "test-value",
          "scopes": [
              "test-value"
          ],
          "extra_params": {
              "key": "test-value"
          },
          "basic_auth_in_header": true,
          "id": "test-value",
          "used_by": {
              "tools": [
                  {
                      "id": "test-value",
                      "name": "test-value",
                      "type": "available",
                      "created_at_unix_secs": 1,
                      "access_level": "admin"
                  }
              ],
              "mcp_servers": [
                  {
                      "id": "test-value",
                      "name": "test-value",
                      "type": "available",
                      "created_at_unix_secs": 1,
                      "access_level": "admin"
                  }
              ],
              "integration_connections": [
                  {
                      "id": "test-value",
                      "name": "test-value"
                  }
              ]
          },
          "status": "active",
          "status_detail": "test-value",
          "status_updated_at": "test-value",
          "custom_headers": {
              "key": "test-value"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $updateOAuth2ClientCredsRequestAuthType =
      \ElevenLabs\Types\UpdateOAuth2ClientCredsRequestAuthType::Oauth2ClientCredentials->value;

    $request = new \ElevenLabs\Types\UpdateOAuth2ClientCredsRequest([
      'authType' => $updateOAuth2ClientCredsRequestAuthType,
      'provider' => 'provider',
      'clientId' => 'client_id',
      'scopes' => [],
      'extraParams' => [],
      'basicAuthInHeader' => false,
      'clientSecret' => 'client_secret',
      'customHeaders' => []
    ]);
    $sdk->workspace->authConnections->update(
      request: $request,
      authConnectionId: 'auth_connection_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/auth-connections/[^/]+$#',
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
    $sdk->workspace->authConnections->delete(authConnectionId: 'auth_connection_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/auth-connections/[^/]+$#',
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

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Secrets;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class SecretsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "secrets": [
              {
                  "type": "stored",
                  "secret_id": "test-value",
                  "name": "test-value",
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
                      "tools_has_more": true,
                      "agents": [
                          {
                              "referenced_resource_ids": [
                                  "test-value"
                              ],
                              "id": "test-value",
                              "name": "test-value",
                              "type": "available",
                              "created_at_unix_secs": 1,
                              "access_level": "admin"
                          }
                      ],
                      "agents_has_more": true,
                      "phone_numbers": [
                          {
                              "phone_number_id": "test-value",
                              "phone_number": "test-value",
                              "label": "test-value",
                              "provider": "twilio"
                          }
                      ],
                      "phone_numbers_has_more": true,
                      "mcp_servers": [
                          {
                              "id": "test-value",
                              "name": "test-value",
                              "type": "available",
                              "created_at_unix_secs": 1,
                              "access_level": "admin"
                          }
                      ],
                      "others": [
                          "conversation_initiation_webhook"
                      ]
                  }
              }
          ],
          "next_cursor": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->secrets->list(
      request: new \ElevenLabs\Agents\Secrets\Requests\ListSecretsRequest([
        'pageSize' => 9,
        'dependencyLimit' => 64,
        'search' => 'search',
        'cursor' => 'cursor'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/secrets$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "type": "stored",
          "secret_id": "test-value",
          "name": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $postWorkspaceSecretRequestType =
      \ElevenLabs\Agents\Secrets\Types\PostWorkspaceSecretRequestType::New_->value;

    $request = new \ElevenLabs\Agents\Secrets\Requests\PostWorkspaceSecretRequest([
      'type' => $postWorkspaceSecretRequestType,
      'name' => 'name',
      'value' => 'value'
    ]);
    $sdk->agents->secrets->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/secrets$#',
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
          "type": "stored",
          "secret_id": "test-value",
          "name": "test-value",
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
              "tools_has_more": true,
              "agents": [
                  {
                      "referenced_resource_ids": [
                          "test-value"
                      ],
                      "id": "test-value",
                      "name": "test-value",
                      "type": "available",
                      "created_at_unix_secs": 1,
                      "access_level": "admin"
                  }
              ],
              "agents_has_more": true,
              "phone_numbers": [
                  {
                      "phone_number_id": "test-value",
                      "phone_number": "test-value",
                      "label": "test-value",
                      "provider": "twilio"
                  }
              ],
              "phone_numbers_has_more": true,
              "mcp_servers": [
                  {
                      "id": "test-value",
                      "name": "test-value",
                      "type": "available",
                      "created_at_unix_secs": 1,
                      "access_level": "admin"
                  }
              ],
              "others": [
                  "conversation_initiation_webhook"
              ]
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->secrets->get(secretId: 'secret_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/secrets/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "type": "stored",
          "secret_id": "test-value",
          "name": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $patchWorkspaceSecretRequestType =
      \ElevenLabs\Agents\Secrets\Types\PatchWorkspaceSecretRequestType::Update->value;

    $request = new \ElevenLabs\Agents\Secrets\Requests\PatchWorkspaceSecretRequest([
      'type' => $patchWorkspaceSecretRequestType,
      'name' => 'name',
      'value' => 'value'
    ]);
    $sdk->agents->secrets->update(request: $request, secretId: 'secret_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/secrets/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(204, '');
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->secrets->delete(secretId: 'secret_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/secrets/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetDependenciesSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "dependencies": [
              {
                  "id": "test-value",
                  "name": "test-value",
                  "type": "available",
                  "created_at_unix_secs": 1,
                  "access_level": "admin"
              }
          ],
          "next_cursor": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $resourceType = \ElevenLabs\Types\SecretDependencyResourceType::Tools;
    $sdk->agents->secrets->getDependencies(
      request: new \ElevenLabs\Agents\Secrets\Requests\GetDependenciesSecretsRequest([
        'pageSize' => 20,
        'cursor' => 'cursor'
      ]),
      secretId: 'secret_id',
      resourceType: $resourceType->value
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/secrets/[^/]+/dependencies/[^/]+$#',
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

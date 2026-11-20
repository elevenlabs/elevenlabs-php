<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\EnvironmentVariables;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class EnvironmentVariablesWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "environment_variables": [
              {
                  "label": "test-value",
                  "created_at_unix_secs": 1,
                  "updated_at_unix_secs": 1,
                  "created_by_user_id": "test-value",
                  "type": "string",
                  "id": "test-value",
                  "workspace_id": "test-value",
                  "values": {
                      "key": "test-value"
                  }
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $type = \ElevenLabs\EnvironmentVariables\Types\ListEnvironmentVariablesRequestType::String;
    $sdk->environmentVariables->list(
      request: new \ElevenLabs\EnvironmentVariables\Requests\ListEnvironmentVariablesRequest([
        'cursor' => 'cursor',
        'pageSize' => 100,
        'label' => 'label',
        'environment' => 'environment',
        'type' => $type->value
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/environment-variables$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "label": "test-value",
          "created_at_unix_secs": 1,
          "updated_at_unix_secs": 1,
          "created_by_user_id": "test-value",
          "type": "string",
          "id": "test-value",
          "workspace_id": "test-value",
          "values": {
              "key": "test-value"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $createStringEnvironmentVariableRequestType =
      \ElevenLabs\Types\CreateStringEnvironmentVariableRequestType::String->value;

    $request = new \ElevenLabs\Types\CreateStringEnvironmentVariableRequest([
      'type' => $createStringEnvironmentVariableRequestType,
      'label' => 'label',
      'values' => []
    ]);
    $sdk->environmentVariables->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/environment-variables$#',
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
          "label": "test-value",
          "created_at_unix_secs": 1,
          "updated_at_unix_secs": 1,
          "created_by_user_id": "test-value",
          "type": "string",
          "id": "test-value",
          "workspace_id": "test-value",
          "values": {
              "key": "test-value"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->environmentVariables->get(envVarId: 'env_var_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/environment-variables/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "label": "test-value",
          "created_at_unix_secs": 1,
          "updated_at_unix_secs": 1,
          "created_by_user_id": "test-value",
          "type": "string",
          "id": "test-value",
          "workspace_id": "test-value",
          "values": {
              "key": "test-value"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $updateEnvironmentVariableRequestValuesValue = new \ElevenLabs\Types\EnvironmentVariableSecretValueRequest(
      [
        'secretId' => 'secret_id'
      ]
    );

    $request = new \ElevenLabs\EnvironmentVariables\Requests\UpdateEnvironmentVariableRequest([
      'values' => []
    ]);
    $sdk->environmentVariables->update(request: $request, envVarId: 'env_var_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/environment-variables/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(204, '');
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->environmentVariables->delete(envVarId: 'env_var_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/environment-variables/[^/]+$#',
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

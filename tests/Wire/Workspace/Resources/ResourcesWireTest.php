<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Workspace\Resources;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ResourcesWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "resource_id": "test-value",
          "resource_name": "test-value",
          "resource_type": "voice",
          "creator_user_id": "test-value",
          "anonymous_access_level_override": "admin",
          "role_to_group_ids": {
              "key": [
                  "test-value"
              ]
          },
          "share_options": [
              {
                  "name": "test-value",
                  "id": "test-value",
                  "type": "user"
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $resourceType = \ElevenLabs\Types\WorkspaceResourceType::Voice;
    $sdk->workspace->resources->get(
      request: new \ElevenLabs\Workspace\Resources\Requests\GetResourcesRequest([
        'resourceType' => $resourceType->value
      ]),
      resourceId: 'resource_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/resources/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    parse_str($sent->getUri()->getQuery(), $query);
    $this->assertArrayHasKey('resource_type', $query);
  }

  public function testShareSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $bodyShareWorkspaceResourceV1WorkspaceResourcesResourceIdSharePostRole =
      \ElevenLabs\Workspace\Resources\Types\BodyShareWorkspaceResourceV1WorkspaceResourcesResourceIdSharePostRole
        ::Admin->value;

    $workspaceResourceType = \ElevenLabs\Types\WorkspaceResourceType::Voice->value;

    $request = new \ElevenLabs\Workspace\Resources\Requests\BodyShareWorkspaceResourceV1WorkspaceResourcesResourceIdSharePost(
      [
        'role' => $bodyShareWorkspaceResourceV1WorkspaceResourcesResourceIdSharePostRole,
        'resourceType' => $workspaceResourceType,
        'userEmail' => 'user_email',
        'groupId' => 'group_id',
        'workspaceApiKeyId' => 'workspace_api_key_id'
      ]
    );
    $sdk->workspace->resources->share(request: $request, resourceId: 'resource_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/resources/[^/]+/share$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testUnshareSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $workspaceResourceType = \ElevenLabs\Types\WorkspaceResourceType::Voice->value;

    $request = new \ElevenLabs\Workspace\Resources\Requests\BodyUnshareWorkspaceResourceV1WorkspaceResourcesResourceIdUnsharePost(
      [
        'resourceType' => $workspaceResourceType,
        'userEmail' => 'user_email',
        'groupId' => 'group_id',
        'workspaceApiKeyId' => 'workspace_api_key_id'
      ]
    );
    $sdk->workspace->resources->unshare(request: $request, resourceId: 'resource_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/resources/[^/]+/unshare$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
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

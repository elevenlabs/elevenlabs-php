<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Workspace\Groups;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class GroupsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "key": {
              "name": "test-value",
              "id": "test-value",
              "members": [
                  "test-value"
              ],
              "permissions": [
                  "text_to_speech"
              ],
              "group_usage_limit": 1,
              "group_pvc_limit": 1,
              "group_concurrency_limit": 1,
              "group_dubbing_concurrency_limit": 1,
              "group_music_concurrency_limit": 1,
              "character_count": 1,
              "is_scim_synced": true,
              "scim_group": {
                  "scim_external_id": "test-value",
                  "display_name": "test-value",
                  "created_at_unix": 1,
                  "updated_at_unix": 1,
                  "seat_type": "workspace_admin"
              },
              "scim_frozen": true
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->workspace->groups->list();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/groups$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testSearchSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      [
          {
              "name": "test-value",
              "id": "test-value",
              "members_emails": [
                  "test-value"
              ]
          }
      ]
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->workspace->groups->search(
      request: new \ElevenLabs\Workspace\Groups\Requests\SearchGroupsRequest([
        'name' => 'name'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/groups/search$#',
      rawurldecode($sent->getUri()->getPath())
    );
    parse_str($sent->getUri()->getQuery(), $query);
    $this->assertArrayHasKey('name', $query);
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

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\Team\Members;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class MembersWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      [
          {
              "user_id": "test-value",
              "email": "test-value",
              "first_name": "test-value",
              "is_owner": true,
              "is_admin": true,
              "picture_url": "test-value",
              "is_suspended": true
          }
      ]
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->team->members->list(
      request: new \ElevenLabs\Reception\Team\Members\Requests\ListMembersRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/team/members$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateRoleSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "key": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $bodySmbUpdateTeamMemberRoleRole =
      \ElevenLabs\Reception\Team\Members\Types\BodySmbUpdateTeamMemberRoleRole::WorkspaceAdmin
        ->value;

    $request = new \ElevenLabs\Reception\Team\Members\Requests\BodySmbUpdateTeamMemberRole([
      'xiWorkspaceId' => 'xi-workspace-id',
      'role' => $bodySmbUpdateTeamMemberRoleRole
    ]);
    $sdk->reception->team->members->updateRole(request: $request, userId: 'user_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/team/members/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testRemoveSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "key": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->team->members->remove(
      request: new \ElevenLabs\Reception\Team\Members\Requests\RemoveMembersRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ]),
      userId: 'user_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/team/members/[^/]+$#',
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

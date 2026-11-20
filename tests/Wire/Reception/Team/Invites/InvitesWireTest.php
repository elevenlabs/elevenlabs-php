<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\Team\Invites;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class InvitesWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      [
          {
              "email": "test-value",
              "seat_type": "workspace_admin",
              "inviting_user_email": "test-value",
              "created_at_unix": 1
          }
      ]
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->team->invites->list(
      request: new \ElevenLabs\Reception\Team\Invites\Requests\ListInvitesRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/team/invites$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
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
    $createTeamInviteRequestRole =
      \ElevenLabs\Reception\Team\Invites\Types\CreateTeamInviteRequestRole::WorkspaceAdmin->value;

    $request = new \ElevenLabs\Reception\Team\Invites\Requests\CreateTeamInviteRequest([
      'xiWorkspaceId' => 'xi-workspace-id',
      'email' => 'sam@example.com',
      'role' => $createTeamInviteRequestRole
    ]);
    $sdk->reception->team->invites->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/team/invites$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testCancelSendsWireRequest(): void
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

    $request = new \ElevenLabs\Reception\Team\Invites\Requests\BodySmbCancelTeamInvite([
      'xiWorkspaceId' => 'xi-workspace-id',
      'email' => 'jane@example.com'
    ]);
    $sdk->reception->team->invites->cancel(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/team/invites$#',
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

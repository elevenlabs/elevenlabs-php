<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\Receptionists\Procedures;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ProceduresWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      [
          {
              "name": "test-value",
              "trigger": "test-value",
              "body": "test-value",
              "id": "test-value",
              "created_at_unix": 1,
              "source_key": "test-value",
              "missing_tools": [
                  "test-value"
              ]
          }
      ]
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->receptionists->procedures->list(
      request: new \ElevenLabs\Reception\Receptionists\Procedures\Requests\ListProceduresRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ]),
      agentId: 'agent_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/customer-facing-agents/[^/]+/procedures$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      201,
      <<<'JSON'
      {
          "name": "test-value",
          "trigger": "test-value",
          "body": "test-value",
          "id": "test-value",
          "created_at_unix": 1,
          "source_key": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Reception\Receptionists\Procedures\Requests\ReceptionCreateProcedureRequest(
      [
        'xiWorkspaceId' => 'xi-workspace-id',
        'name' => 'sit minim',
        'trigger' => 'aute d',
        'body' =>
          "1. Ask for the caller\'s name and order number.\n2. Look up the order and read back its status."
      ]
    );
    $sdk->reception->receptionists->procedures->create(
      request: $request,
      agentId: 'agent_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/customer-facing-agents/[^/]+/procedures$#',
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
          "trigger": "test-value",
          "body": "test-value",
          "id": "test-value",
          "created_at_unix": 1,
          "source_key": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Reception\Receptionists\Procedures\Requests\ReceptionUpdateProcedureRequest(
      [
        'xiWorkspaceId' => 'xi-workspace-id',
        'name' => 'in sunt',
        'trigger' => 'adipisicing ',
        'body' =>
          "1. Ask for the caller\'s name and order number.\n2. Look up the order and read back its status."
      ]
    );
    $sdk->reception->receptionists->procedures->update(
      request: $request,
      agentId: 'agent_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      procedureId: 'agtprc_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PUT', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/customer-facing-agents/[^/]+/procedures/[^/]+$#',
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
      {
          "key": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->receptionists->procedures->delete(
      request: new \ElevenLabs\Reception\Receptionists\Procedures\Requests\DeleteProceduresRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ]),
      agentId: 'agent_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      procedureId: 'agtprc_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/customer-facing-agents/[^/]+/procedures/[^/]+$#',
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

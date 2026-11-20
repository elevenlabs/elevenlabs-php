<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Procedures\Drafts;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class DraftsWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "procedure_id": "test-value",
          "name": "test-value",
          "content": "test-value",
          "type": "free_form",
          "trigger": "test-value",
          "folder_parent_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->procedures->drafts->get(
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
      branchId: 'agtbranch_0901k4aafjxxfxt93gd841r7tv5t',
      procedureId: 'agtprc_6qbpwdq8n01bxhk44bgjy6f10ck3'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/branches/[^/]+/procedures/[^/]+/draft$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "procedure_id": "test-value",
          "name": "test-value",
          "content": "test-value",
          "type": "free_form",
          "trigger": "test-value",
          "folder_parent_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $procedureType = \ElevenLabs\Types\ProcedureType::FreeForm->value;

    $request = new \ElevenLabs\Agents\Procedures\Drafts\Requests\UpdateProcedureDraftRequestModel([
      'name' => 'name',
      'content' => 'content',
      'type' => $procedureType,
      'trigger' => 'trigger'
    ]);
    $sdk->agents->procedures->drafts->update(
      request: $request,
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
      branchId: 'agtbranch_0901k4aafjxxfxt93gd841r7tv5t',
      procedureId: 'agtprc_6qbpwdq8n01bxhk44bgjy6f10ck3'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/branches/[^/]+/procedures/[^/]+/draft$#',
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
    $sdk->agents->procedures->drafts->delete(
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
      branchId: 'agtbranch_0901k4aafjxxfxt93gd841r7tv5t',
      procedureId: 'agtprc_6qbpwdq8n01bxhk44bgjy6f10ck3'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/branches/[^/]+/procedures/[^/]+/draft$#',
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

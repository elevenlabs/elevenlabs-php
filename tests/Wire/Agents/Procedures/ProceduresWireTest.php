<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Procedures;

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
      {
          "procedures": [
              {
                  "procedure_id": "test-value",
                  "version_id": "test-value",
                  "name": "test-value",
                  "type": "free_form",
                  "trigger": "test-value",
                  "has_draft": true,
                  "referenced_tool_ids": [
                      "test-value"
                  ],
                  "referenced_kb_ids": [
                      "test-value"
                  ],
                  "referenced_procedure_ids": [
                      "test-value"
                  ],
                  "referenced_dynamic_variables": [
                      "test-value"
                  ],
                  "written_dynamic_variables": [
                      "test-value"
                  ],
                  "folder_parent_id": "test-value"
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->procedures->list(
      request: new \ElevenLabs\Agents\Procedures\Requests\ListProceduresRequest([
        'agentVersionId' => 'agent_version_id'
      ]),
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
      branchId: 'agtbranch_0901k4aafjxxfxt93gd841r7tv5t'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/branches/[^/]+/procedures$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "procedure_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $procedureType = \ElevenLabs\Types\ProcedureType::FreeForm->value;

    $request = new \ElevenLabs\Types\CreateProcedureRequestModel([
      'name' => 'name',
      'content' => 'content',
      'type' => $procedureType,
      'trigger' => 'trigger',
      'folderParentId' => 'folder_parent_id'
    ]);
    $sdk->agents->procedures->create(
      request: $request,
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
      branchId: 'agtbranch_0901k4aafjxxfxt93gd841r7tv5t'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/branches/[^/]+/procedures$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testCompileSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "workflow": {
              "edges": {
                  "key": {
                      "source": "test-value",
                      "target": "test-value",
                      "forward_condition": {
                          "label": "test-value",
                          "type": "unconditional"
                      },
                      "backward_condition": {
                          "label": "test-value",
                          "type": "unconditional"
                      },
                      "reroutes": [
                          {
                              "x": 1,
                              "y": 1
                          }
                      ]
                  }
              },
              "nodes": {
                  "key": {
                      "type": "start",
                      "position": {
                          "x": 1,
                          "y": 1
                      },
                      "edge_order": [
                          "test-value"
                      ]
                  }
              },
              "prevent_subagent_loops": true
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->procedures->compile(
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
      branchId: 'agtbranch_0901k4aafjxxfxt93gd841r7tv5t'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/branches/[^/]+/procedures/compile$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "procedure_id": "test-value",
          "version_id": "test-value",
          "name": "test-value",
          "content": "test-value",
          "type": "free_form",
          "trigger": "test-value",
          "folder_parent_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->procedures->get(
      request: new \ElevenLabs\Agents\Procedures\Requests\GetProceduresRequest([
        'versionId' => 'version_id',
        'agentVersionId' => 'agent_version_id'
      ]),
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
      branchId: 'agtbranch_0901k4aafjxxfxt93gd841r7tv5t',
      procedureId: 'agtprc_6qbpwdq8n01bxhk44bgjy6f10ck3'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/branches/[^/]+/procedures/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testRemoveSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->procedures->remove(
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
      branchId: 'agtbranch_0901k4aafjxxfxt93gd841r7tv5t',
      procedureId: 'agtprc_6qbpwdq8n01bxhk44bgjy6f10ck3'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/branches/[^/]+/procedures/[^/]+$#',
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

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Drafts;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class DraftsWireTest extends TestCase
{
  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $workflowUnconditionalModelInputType =
      \ElevenLabs\Types\WorkflowUnconditionalModelInputType::Unconditional->value;

    $workflowUnconditionalModelInput = new \ElevenLabs\Types\WorkflowUnconditionalModelInput([
      'label' => 'label',
      'type' => $workflowUnconditionalModelInputType
    ]);
    $workflowEdgeModelInputForwardCondition = \ElevenLabs\Types\WorkflowEdgeModelInputForwardCondition::unconditional(
      $workflowUnconditionalModelInput
    );

    $workflowEdgeModelInputBackwardCondition = \ElevenLabs\Types\WorkflowEdgeModelInputBackwardCondition::unconditional(
      $workflowUnconditionalModelInput
    );

    $positionInput = new \ElevenLabs\Types\PositionInput([
      'x' => 0.13,
      'y' => 8.06
    ]);

    $workflowEdgeModelInput = new \ElevenLabs\Types\WorkflowEdgeModelInput([
      'source' => 'source',
      'target' => 'target',
      'forwardCondition' => $workflowEdgeModelInputForwardCondition,
      'backwardCondition' => $workflowEdgeModelInputBackwardCondition,
      'reroutes' => []
    ]);

    $workflowStartNodeModelInputType =
      \ElevenLabs\Types\WorkflowStartNodeModelInputType::Start->value;

    $workflowStartNodeModelInput = new \ElevenLabs\Types\WorkflowStartNodeModelInput([
      'type' => $workflowStartNodeModelInputType,
      'position' => $positionInput,
      'edgeOrder' => []
    ]);
    $agentWorkflowRequestModelNodesValue = \ElevenLabs\Types\AgentWorkflowRequestModelNodesValue::start(
      $workflowStartNodeModelInput
    );

    $agentWorkflowRequestModel = new \ElevenLabs\Types\AgentWorkflowRequestModel([
      'edges' => [],
      'nodes' => [],
      'preventSubagentLoops' => false
    ]);

    $request = new \ElevenLabs\Agents\Drafts\Requests\BodyCreateAgentDraftV1ConvaiAgentsAgentIdDraftsPost(
      [
        'branchId' => 'agtbrch_8901k4t9z5defmb8vh3e9361y7nj',
        'conversationConfig' => [],
        'platformSettings' => [],
        'workflow' => $agentWorkflowRequestModel,
        'name' => 'name',
        'tags' => []
      ]
    );
    $sdk->agents->drafts->create(request: $request, agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/drafts$#',
      rawurldecode($sent->getUri()->getPath())
    );
    parse_str($sent->getUri()->getQuery(), $query);
    $this->assertArrayHasKey('branch_id', $query);
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
    $sdk->agents->drafts->delete(
      request: new \ElevenLabs\Agents\Drafts\Requests\DeleteDraftsRequest([
        'branchId' => 'agtbrch_8901k4t9z5defmb8vh3e9361y7nj'
      ]),
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/drafts$#',
      rawurldecode($sent->getUri()->getPath())
    );
    parse_str($sent->getUri()->getQuery(), $query);
    $this->assertArrayHasKey('branch_id', $query);
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

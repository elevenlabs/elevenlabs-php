<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Deployments;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class DeploymentsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "meta": {
              "total": 1,
              "page": 1,
              "page_size": 1
          },
          "results": [
              {
                  "id": "test-value",
                  "traffic_percentage_branch_id_map": {
                      "key": 1
                  },
                  "deployed_at_unix_secs": 1,
                  "is_active": true,
                  "source": "manual",
                  "access_info": {
                      "is_creator": true,
                      "creator_name": "test-value",
                      "creator_email": "test-value",
                      "role": "admin",
                      "anonymous_access_level_override": "admin",
                      "access_source": "creator"
                  }
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->deployments->list(
      request: new \ElevenLabs\Agents\Deployments\Requests\ListDeploymentsRequest([
        'page' => 1,
        'pageSize' => 30
      ]),
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/deployments$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "traffic_percentage_branch_id_map": {
              "key": 1
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $agentDeploymentPercentageStrategyType =
      \ElevenLabs\Types\AgentDeploymentPercentageStrategyType::Percentage->value;

    $agentDeploymentPercentageStrategy = new \ElevenLabs\Types\AgentDeploymentPercentageStrategy([
      'type' => $agentDeploymentPercentageStrategyType,
      'trafficPercentage' => 0.5
    ]);

    $agentDeploymentRequestItem = new \ElevenLabs\Types\AgentDeploymentRequestItem([
      'branchId' => 'agtbrch_8901k4t9z5defmb8vh3e9361y7nj',
      'deploymentStrategy' => $agentDeploymentPercentageStrategy
    ]);

    $agentDeploymentRequest = new \ElevenLabs\Types\AgentDeploymentRequest([
      'requests' => []
    ]);

    $request = new \ElevenLabs\Agents\Deployments\Requests\BodyCreateOrUpdateDeploymentsV1ConvaiAgentsAgentIdDeploymentsPost(
      [
        'deploymentRequest' => $agentDeploymentRequest
      ]
    );
    $sdk->agents->deployments->create(
      request: $request,
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/deployments$#',
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

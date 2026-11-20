<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Subagents;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class SubagentsWireTest extends TestCase
{
  public function testGetDependentsSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agents": [
              {
                  "referenced_resource_ids": [
                      "test-value"
                  ],
                  "id": "test-value",
                  "name": "test-value",
                  "type": "available",
                  "created_at_unix_secs": 1,
                  "access_level": "admin"
              }
          ],
          "branches": [
              {
                  "agent_id": "test-value",
                  "agent_name": "test-value",
                  "branch_id": "test-value",
                  "branch_name": "test-value",
                  "is_main": true
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->subagents->getDependents(
      request: new \ElevenLabs\Agents\Subagents\Requests\GetDependentsSubagentsRequest([
        'pageSize' => 30,
        'cursor' => 'cursor'
      ]),
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/subagent-dependents$#',
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

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Tools\Executions;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ExecutionsWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "executions": [
              {
                  "tool_id": "test-value",
                  "tool_request_id": "test-value",
                  "conversation_id": "test-value",
                  "agent_id": "test-value",
                  "branch_id": "test-value",
                  "timestamp": 1,
                  "latency_secs": 1,
                  "is_error": true,
                  "request_payload": "test-value",
                  "response_payload": "test-value",
                  "error_message": "test-value",
                  "error_type": "test-value",
                  "id": "test-value",
                  "tool_call_details": {
                      "type": "webhook",
                      "method": "test-value",
                      "url": "test-value",
                      "headers": {
                          "key": "test-value"
                      },
                      "path_params": {
                          "key": "test-value"
                      },
                      "query_params": {
                          "key": "test-value"
                      },
                      "body": "test-value"
                  }
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->tools->executions->get(
      request: new \ElevenLabs\Agents\Tools\Executions\Requests\GetExecutionsRequest([
        'cursor' => 'cursor',
        'pageSize' => 30,
        'isError' => true,
        'agentId' => 'agent_id',
        'branchId' => 'branch_id',
        'startTime' => 0.63,
        'endTime' => 5.28
      ]),
      toolId: 'tool_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/tools/[^/]+/executions$#',
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

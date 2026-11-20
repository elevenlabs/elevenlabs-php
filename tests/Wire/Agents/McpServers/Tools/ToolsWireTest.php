<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\McpServers\Tools;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ToolsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "success": true,
          "tools": [
              {
                  "name": "test-value",
                  "title": "test-value",
                  "description": "test-value",
                  "inputSchema": {
                      "key": "test-value"
                  },
                  "execution": {
                      "taskSupport": "forbidden"
                  },
                  "outputSchema": {
                      "key": "test-value"
                  },
                  "icons": [
                      {
                          "src": "test-value",
                          "mimeType": "test-value",
                          "sizes": [
                              "test-value"
                          ],
                          "theme": "light"
                      }
                  ],
                  "annotations": {
                      "title": "test-value",
                      "readOnlyHint": true,
                      "destructiveHint": true,
                      "idempotentHint": true,
                      "openWorldHint": true
                  },
                  "_meta": {
                      "key": "test-value"
                  }
              }
          ],
          "tool_approval_statuses": [
              {
                  "tool_id": "test-value",
                  "state": "up_to_date",
                  "approval_policy": "auto_approved",
                  "approved_definition": {
                      "description": "test-value",
                      "input_schema": {
                          "key": "test-value"
                      }
                  }
              }
          ],
          "error_message": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->mcpServers->tools->list(
      request: new \ElevenLabs\Agents\McpServers\Tools\Requests\ListToolsRequest([
        'environment' => 'production'
      ]),
      mcpServerId: 'mcp_server_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/mcp-servers/[^/]+/tools$#',
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

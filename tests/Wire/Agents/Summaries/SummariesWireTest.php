<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Summaries;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class SummariesWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "key": {
              "status": "success",
              "data": {
                  "agent_id": "test-value",
                  "name": "test-value",
                  "voice_id": "test-value",
                  "tags": [
                      "test-value"
                  ],
                  "created_at_unix_secs": 1,
                  "updated_at_unix_secs": 1,
                  "access_info": {
                      "is_creator": true,
                      "creator_name": "test-value",
                      "creator_email": "test-value",
                      "role": "admin",
                      "anonymous_access_level_override": "admin",
                      "access_source": "creator"
                  },
                  "last_call_time_unix_secs": 1,
                  "archived": true
              }
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->summaries->get(
      request: new \ElevenLabs\Agents\Summaries\Requests\GetSummariesRequest([
        'agentIds' => ['agent_ids']
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/summaries$#',
      rawurldecode($sent->getUri()->getPath())
    );
    parse_str($sent->getUri()->getQuery(), $query);
    $this->assertArrayHasKey('agent_ids', $query);
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

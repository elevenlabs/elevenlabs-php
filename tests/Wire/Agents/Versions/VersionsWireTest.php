<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Versions;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class VersionsWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "agent_id": "test-value",
          "branch_id": "test-value",
          "version_description": "test-value",
          "seq_no_in_branch": 1,
          "time_committed_secs": 1,
          "parents": {
              "in_branch_parent_id": "test-value",
              "out_of_branch_parent_id": "test-value",
              "merged_into_branch_id": "test-value",
              "merged_from_branch_id": "test-value",
              "merged_from_version_id": "test-value",
              "rebased_from_version_id": "test-value"
          },
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          },
          "merged_authors": [
              {
                  "is_creator": true,
                  "creator_name": "test-value",
                  "creator_email": "test-value",
                  "role": "admin",
                  "anonymous_access_level_override": "admin",
                  "access_source": "creator"
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->versions->get(
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
      versionId: 'agtvrsn_0901k4aafjxxfxt93gd841r7tv5t'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/versions/[^/]+$#',
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

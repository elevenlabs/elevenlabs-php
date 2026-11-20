<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\Receptionists\Rules;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class RulesWireTest extends TestCase
{
  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "title": "test-value",
          "description": "test-value",
          "priority": "strict",
          "id": "test-value",
          "created_at_unix": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $rulePriority = \ElevenLabs\Types\RulePriority::Strict->value;

    $request = new \ElevenLabs\Reception\Receptionists\Rules\Requests\ReceptionCreateAgentRuleRequest(
      [
        'xiWorkspaceId' => 'xi-workspace-id',
        'title' => 'eiusmod Ut c',
        'description' => 'fugia',
        'priority' => $rulePriority
      ]
    );
    $sdk->reception->receptionists->rules->create(
      request: $request,
      agentId: 'agent_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/customer-facing-agents/[^/]+/rules$#',
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
          "title": "test-value",
          "description": "test-value",
          "priority": "strict",
          "id": "test-value",
          "created_at_unix": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $rulePriority = \ElevenLabs\Types\RulePriority::Strict->value;

    $request = new \ElevenLabs\Reception\Receptionists\Rules\Requests\ReceptionUpdateAgentRuleRequest(
      [
        'xiWorkspaceId' => 'xi-workspace-id',
        'title' => 'ut id',
        'description' => 'ad Duis',
        'priority' => $rulePriority
      ]
    );
    $sdk->reception->receptionists->rules->update(
      request: $request,
      agentId: 'agent_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      ruleId: 'rule_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PUT', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/customer-facing-agents/[^/]+/rules/[^/]+$#',
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
    $sdk->reception->receptionists->rules->delete(
      request: new \ElevenLabs\Reception\Receptionists\Rules\Requests\DeleteRulesRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ]),
      agentId: 'agent_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      ruleId: 'rule_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/customer-facing-agents/[^/]+/rules/[^/]+$#',
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

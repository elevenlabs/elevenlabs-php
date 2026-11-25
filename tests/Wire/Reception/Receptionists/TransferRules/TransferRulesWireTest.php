<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\Receptionists\TransferRules;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class TransferRulesWireTest extends TestCase
{
  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "label": "test-value",
          "phone_number": "test-value",
          "condition": "test-value",
          "post_dial_digits": "test-value",
          "id": "test-value",
          "created_at_unix": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Reception\Receptionists\TransferRules\Requests\ReceptionCreateTransferRuleRequest(
      [
        'xiWorkspaceId' => 'xi-workspace-id',
        'label' => 'esse eu',
        'phoneNumber' => 'in conseq',
        'condition' => 'elit ',
        'postDialDigits' => '1969615'
      ]
    );
    $sdk->reception->receptionists->transferRules->create(
      request: $request,
      agentId: 'agent_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/customer-facing-agents/[^/]+/transfer-rules$#',
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
          "label": "test-value",
          "phone_number": "test-value",
          "condition": "test-value",
          "post_dial_digits": "test-value",
          "id": "test-value",
          "created_at_unix": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Reception\Receptionists\TransferRules\Requests\ReceptionUpdateTransferRuleRequest(
      [
        'xiWorkspaceId' => 'xi-workspace-id',
        'label' => 'culpa',
        'phoneNumber' => 'occaec',
        'condition' => 'Ut do u',
        'postDialDigits' => '#wW'
      ]
    );
    $sdk->reception->receptionists->transferRules->update(
      request: $request,
      agentId: 'agent_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      ruleId: 'transferrule_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PUT', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/customer-facing-agents/[^/]+/transfer-rules/[^/]+$#',
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
    $sdk->reception->receptionists->transferRules->delete(
      request: new \ElevenLabs\Reception\Receptionists\TransferRules\Requests\DeleteTransferRulesRequest(
        [
          'xiWorkspaceId' => 'xi-workspace-id'
        ]
      ),
      agentId: 'agent_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      ruleId: 'transferrule_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/customer-facing-agents/[^/]+/transfer-rules/[^/]+$#',
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

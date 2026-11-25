<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Workspace\AuditLogs;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class AuditLogsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "entries": [
              {
                  "metadata": {
                      "key": "test-value"
                  },
                  "time": 1,
                  "activity_id": 0,
                  "activity_name": "test-value",
                  "category_name": "test-value",
                  "category_uid": 1,
                  "class_name": "test-value",
                  "class_uid": 1,
                  "severity_id": 0,
                  "status_id": 0,
                  "actor": {
                      "user": {
                          "name": "test-value",
                          "uid": "test-value",
                          "type_id": 0,
                          "type": "test-value",
                          "email_addr": "test-value",
                          "full_name": "test-value",
                          "domain": "test-value"
                      },
                      "app_name": "test-value",
                      "app_uid": "test-value",
                      "session": {
                          "key": "test-value"
                      }
                  },
                  "device": {
                      "ip": "test-value",
                      "hostname": "test-value",
                      "type_id": 1
                  },
                  "http_request": {
                      "http_method": "test-value",
                      "url": {
                          "url_string": "test-value",
                          "scheme": "test-value",
                          "hostname": "test-value",
                          "port": 1,
                          "path": "test-value",
                          "query_string": "test-value"
                      },
                      "user_agent": "test-value",
                      "x_forwarded_for": [
                          "test-value"
                      ]
                  },
                  "message": "test-value",
                  "unmapped": {
                      "key": "test-value"
                  },
                  "id": "test-value",
                  "time_dt": "test-value",
                  "type_uid": 1,
                  "type_name": "test-value"
              }
          ],
          "has_more": true,
          "next_cursor": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $className = \ElevenLabs\Types\AuditClassName::AccountChange;
    $activityName = \ElevenLabs\Types\AuditActivityName::AccountSecurityChange;
    $sdk->workspace->auditLogs->list(
      request: new \ElevenLabs\Workspace\AuditLogs\Requests\ListAuditLogsRequest([
        'limit' => 50,
        'cursor' => 'cursor',
        'timeFromUnixMs' => 9,
        'timeToUnixMs' => 1,
        'actorUid' => 'actor_uid',
        'className' => $className->value,
        'activityName' => $activityName->value
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/audit-logs$#',
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

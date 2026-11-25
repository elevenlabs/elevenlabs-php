<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Workspace\Analytics\Requests;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class RequestsWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "columns": [
              "test-value"
          ],
          "column_types": [
              "String"
          ],
          "rows": [
              [
                  "test-value"
              ]
          ],
          "column_units": [
              "ms"
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $bodyListApiRequestsV1WorkspaceAnalyticsRequestsPostSort =
      \ElevenLabs\Workspace\Analytics\Requests\Types\BodyListApiRequestsV1WorkspaceAnalyticsRequestsPostSort
        ::Asc->value;

    $columnFilterOperation = \ElevenLabs\Types\ColumnFilterOperation::In->value;

    $columnFilterValuesItem = 'ut officia ex';

    $columnFilter = new \ElevenLabs\Types\ColumnFilter([
      'column' => 'column',
      'operation' => $columnFilterOperation,
      'values' => []
    ]);

    $request = new \ElevenLabs\Workspace\Analytics\Requests\Requests\BodyListApiRequestsV1WorkspaceAnalyticsRequestsPost(
      [
        'startTime' => 6604239070123704,
        'endTime' => 6061767457568659,
        'limit' => 100,
        'sort' => $bodyListApiRequestsV1WorkspaceAnalyticsRequestsPostSort,
        'filters' => [],
        'search' => 'search'
      ]
    );
    $sdk->workspace->analytics->requests->get(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/analytics/requests$#',
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

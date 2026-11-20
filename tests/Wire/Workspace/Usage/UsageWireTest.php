<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Workspace\Usage;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class UsageWireTest extends TestCase
{
  public function testGetUsageByProductOverTimeSendsWireRequest(): void
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
    $bodyGetWorkspaceUsageV1WorkspaceAnalyticsQueryUsageByProductOverTimePostGroupByItem =
      \ElevenLabs\Workspace\Usage\Types\BodyGetWorkspaceUsageV1WorkspaceAnalyticsQueryUsageByProductOverTimePostGroupByItem
        ::ProductType->value;

    $columnFilterOperation = \ElevenLabs\Types\ColumnFilterOperation::In->value;

    $columnFilterValuesItem = []; // TODO: populate with required fields

    $columnFilter = new \ElevenLabs\Types\ColumnFilter([
      'column' => 'column',
      'operation' => $columnFilterOperation,
      'values' => []
    ]);

    $request = new \ElevenLabs\Workspace\Usage\Requests\BodyGetWorkspaceUsageV1WorkspaceAnalyticsQueryUsageByProductOverTimePost(
      [
        'startTime' => 6919743446933494,
        'endTime' => 3429310445613611,
        'intervalSeconds' => 60,
        'groupBy' => [],
        'filters' => [],
        'timeZone' => 'UTC'
      ]
    );
    $sdk->workspace->usage->getUsageByProductOverTime(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/analytics/query/usage-by-product-over-time$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testGetUsageSendsWireRequest(): void
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
    $bodyGetWorkspaceCostUsageV1WorkspaceAnalyticsUsagePostGroupByItem =
      \ElevenLabs\Workspace\Usage\Types\BodyGetWorkspaceCostUsageV1WorkspaceAnalyticsUsagePostGroupByItem
        ::Model->value;

    $metronomeUsageColumnFilterColumn =
      \ElevenLabs\Types\MetronomeUsageColumnFilterColumn::Model->value;

    $metronomeUsageColumnFilterOperation =
      \ElevenLabs\Types\MetronomeUsageColumnFilterOperation::Eq->value;

    $metronomeUsageColumnFilterValuesItem = []; // TODO: populate with required fields

    $metronomeUsageColumnFilter = new \ElevenLabs\Types\MetronomeUsageColumnFilter([
      'column' => $metronomeUsageColumnFilterColumn,
      'operation' => $metronomeUsageColumnFilterOperation,
      'values' => []
    ]);

    $request = new \ElevenLabs\Workspace\Usage\Requests\BodyGetWorkspaceCostUsageV1WorkspaceAnalyticsUsagePost(
      [
        'startTime' => 6052980653121348,
        'endTime' => 3339925748020137,
        'intervalSeconds' => 5811589424476800,
        'groupBy' => [],
        'filters' => []
      ]
    );
    $sdk->workspace->usage->getUsage(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/workspace/analytics/usage$#',
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

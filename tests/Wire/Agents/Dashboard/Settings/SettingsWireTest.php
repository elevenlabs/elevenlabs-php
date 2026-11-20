<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Dashboard\Settings;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class SettingsWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "charts": [
              {
                  "name": "test-value",
                  "type": "call_success"
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->dashboard->settings->get();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/settings/dashboard$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "charts": [
              {
                  "name": "test-value",
                  "type": "call_success"
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $dashboardCallSuccessChartModelType =
      \ElevenLabs\Types\DashboardCallSuccessChartModelType::CallSuccess->value;

    $dashboardCallSuccessChartModel = new \ElevenLabs\Types\DashboardCallSuccessChartModel([
      'name' => 'name',
      'type' => $dashboardCallSuccessChartModelType
    ]);
    $patchConvAiDashboardSettingsRequestChartsItem = \ElevenLabs\Agents\Dashboard\Settings\Types\PatchConvAiDashboardSettingsRequestChartsItem::callSuccess(
      $dashboardCallSuccessChartModel
    );

    $request = new \ElevenLabs\Agents\Dashboard\Settings\Requests\PatchConvAiDashboardSettingsRequest(
      [
        'charts' => []
      ]
    );
    $sdk->agents->dashboard->settings->update(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/settings/dashboard$#',
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

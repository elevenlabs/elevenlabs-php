<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\BusinessProfile;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class BusinessProfileWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "business_name": "test-value",
          "business_country": "test-value",
          "business_description": "test-value",
          "timezone": "test-value",
          "currency": "USD",
          "operating_hours": {
              "hours": {
                  "key": [
                      {
                          "start_hour": 0,
                          "start_minute": 0,
                          "end_hour": 0,
                          "end_minute": 0
                      }
                  ]
              },
              "timezone": "test-value"
          },
          "tool_call_sound": "typing",
          "id": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1,
          "workspace_now": {
              "today": {
                  "year": 2026,
                  "month": 1,
                  "day": 1
              },
              "hour": 0,
              "minute": 0,
              "fetched_at_ms": 1
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->businessProfile->get(
      request: new \ElevenLabs\Reception\BusinessProfile\Requests\GetBusinessProfileRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/agent-info$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "business_name": "test-value",
          "business_country": "test-value",
          "business_description": "test-value",
          "timezone": "test-value",
          "currency": "USD",
          "operating_hours": {
              "hours": {
                  "key": [
                      {
                          "start_hour": 0,
                          "start_minute": 0,
                          "end_hour": 0,
                          "end_minute": 0
                      }
                  ]
              },
              "timezone": "test-value"
          },
          "tool_call_sound": "typing",
          "id": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1,
          "workspace_now": {
              "today": {
                  "year": 2026,
                  "month": 1,
                  "day": 1
              },
              "hour": 0,
              "minute": 0,
              "fetched_at_ms": 1
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $receptionUpdateAgentInfoRequestCurrency =
      \ElevenLabs\Reception\BusinessProfile\Types\ReceptionUpdateAgentInfoRequestCurrency::Usd
        ->value;

    $timeRangeModel = new \ElevenLabs\Types\TimeRangeModel([
      'startHour' => 9,
      'startMinute' => 8,
      'endHour' => 17,
      'endMinute' => 30
    ]);

    $workingHours = new \ElevenLabs\Types\WorkingHours([
      'hours' => [],
      'timezone' => 'timezone'
    ]);

    $toolCallSoundType = \ElevenLabs\Types\ToolCallSoundType::Typing->value;

    $request = new \ElevenLabs\Reception\BusinessProfile\Requests\ReceptionUpdateAgentInfoRequest([
      'xiWorkspaceId' => 'xi-workspace-id',
      'businessName' => 'Bloom Salon',
      'businessCountry' => 'id Duis',
      'businessDescription' => 'A hair salon offering cuts, color and styling.',
      'timezone' => 'America/New_York',
      'currency' => $receptionUpdateAgentInfoRequestCurrency,
      'operatingHours' => $workingHours,
      'toolCallSound' => $toolCallSoundType
    ]);
    $sdk->reception->businessProfile->update(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PUT', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/agent-info$#',
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

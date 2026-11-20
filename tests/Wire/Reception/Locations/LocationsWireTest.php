<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\Locations;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class LocationsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      [
          {
              "name": "test-value",
              "address": "test-value",
              "notes": "test-value",
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
              "customer_facing_name": "test-value",
              "max_concurrent_appointments": 1,
              "id": "test-value",
              "deactivated_at_unix": 1,
              "deactivation_reason": "tier_downgrade",
              "is_active": true
          }
      ]
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->locations->list(
      request: new \ElevenLabs\Reception\Locations\Requests\ListLocationsRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/locations$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "name": "test-value",
          "address": "test-value",
          "notes": "test-value",
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
          "customer_facing_name": "test-value",
          "max_concurrent_appointments": 1,
          "id": "test-value",
          "deactivated_at_unix": 1,
          "deactivation_reason": "tier_downgrade",
          "is_active": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $timeRangeModel = new \ElevenLabs\Types\TimeRangeModel([
      'startHour' => 9,
      'startMinute' => 2,
      'endHour' => 17,
      'endMinute' => 30
    ]);

    $workingHours = new \ElevenLabs\Types\WorkingHours([
      'hours' => [],
      'timezone' => 'timezone'
    ]);

    $request = new \ElevenLabs\Reception\Locations\Requests\ReceptionLocationRequest([
      'xiWorkspaceId' => 'xi-workspace-id',
      'name' => 'nulla',
      'address' => 'ut est consect',
      'notes' => 'qui c',
      'operatingHours' => $workingHours,
      'customerFacingName' => 'eu voluptate',
      'maxConcurrentAppointments' => 3,
      'isActive' => true
    ]);
    $sdk->reception->locations->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/locations$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "name": "test-value",
          "address": "test-value",
          "notes": "test-value",
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
          "customer_facing_name": "test-value",
          "max_concurrent_appointments": 1,
          "id": "test-value",
          "deactivated_at_unix": 1,
          "deactivation_reason": "tier_downgrade",
          "is_active": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->locations->get(
      request: new \ElevenLabs\Reception\Locations\Requests\GetLocationsRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ]),
      locationId: 'location_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/locations/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "name": "test-value",
          "address": "test-value",
          "notes": "test-value",
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
          "customer_facing_name": "test-value",
          "max_concurrent_appointments": 1,
          "id": "test-value",
          "deactivated_at_unix": 1,
          "deactivation_reason": "tier_downgrade",
          "is_active": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $timeRangeModel = new \ElevenLabs\Types\TimeRangeModel([
      'startHour' => 9,
      'startMinute' => 2,
      'endHour' => 17,
      'endMinute' => 30
    ]);

    $workingHours = new \ElevenLabs\Types\WorkingHours([
      'hours' => [],
      'timezone' => 'timezone'
    ]);

    $request = new \ElevenLabs\Reception\Locations\Requests\ReceptionLocationRequestPatch([
      'xiWorkspaceId' => 'xi-workspace-id',
      'name' => 'ullamco laboris',
      'address' => 'in enim',
      'notes' => 'nulla ',
      'operatingHours' => $workingHours,
      'customerFacingName' => 'adipisicing',
      'maxConcurrentAppointments' => 3,
      'isActive' => true
    ]);
    $sdk->reception->locations->update(
      request: $request,
      locationId: 'location_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PUT', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/locations/[^/]+$#',
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
    $sdk->reception->locations->delete(
      request: new \ElevenLabs\Reception\Locations\Requests\DeleteLocationsRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ]),
      locationId: 'location_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/locations/[^/]+$#',
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

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\Holidays;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class HolidaysWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      [
          {
              "name": "test-value",
              "start_date": {
                  "year": 2026,
                  "month": 1,
                  "day": 1
              },
              "end_date": {
                  "year": 2026,
                  "month": 1,
                  "day": 1
              },
              "holiday_type": "closed",
              "override_hours": [
                  {
                      "start_hour": 0,
                      "start_minute": 0,
                      "end_hour": 0,
                      "end_minute": 0
                  }
              ],
              "time_off_type": "staff",
              "resource_id": "test-value",
              "location_id": "test-value",
              "reason": "test-value",
              "id": "test-value",
              "created_at_unix": 1,
              "updated_at_unix": 1
          }
      ]
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $timeOffType = \ElevenLabs\Types\TimeOffType::Staff;
    $sdk->reception->holidays->list(
      request: new \ElevenLabs\Reception\Holidays\Requests\ListHolidaysRequest([
        'startUnix' => 10,
        'endUnix' => 5,
        'timeOffType' => $timeOffType->value,
        'resourceId' => 'resource_id',
        'locationId' => 'location_id',
        'xiWorkspaceId' => 'xi-workspace-id'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/holidays$#',
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
          "start_date": {
              "year": 2026,
              "month": 1,
              "day": 1
          },
          "end_date": {
              "year": 2026,
              "month": 1,
              "day": 1
          },
          "holiday_type": "closed",
          "override_hours": [
              {
                  "start_hour": 0,
                  "start_minute": 0,
                  "end_hour": 0,
                  "end_minute": 0
              }
          ],
          "time_off_type": "staff",
          "resource_id": "test-value",
          "location_id": "test-value",
          "reason": "test-value",
          "id": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $dateModel = new \ElevenLabs\Types\DateModel([
      'year' => 2026,
      'month' => 12,
      'day' => 25
    ]);

    $holidayType = \ElevenLabs\Types\HolidayType::Closed->value;

    $timeRangeModel = new \ElevenLabs\Types\TimeRangeModel([
      'startHour' => 9,
      'startMinute' => 8,
      'endHour' => 17,
      'endMinute' => 30
    ]);

    $timeOffType = \ElevenLabs\Types\TimeOffType::Staff->value;

    $request = new \ElevenLabs\Reception\Holidays\Requests\ReceptionCreateHolidayRequest([
      'xiWorkspaceId' => 'xi-workspace-id',
      'name' => 'Christmas Eve',
      'startDate' => $dateModel,
      'endDate' => $dateModel,
      'holidayType' => $holidayType,
      'overrideHours' => [],
      'timeOffType' => $timeOffType,
      'resourceId' => 'resource_id',
      'locationId' => 'location_id',
      'reason' => 'reason'
    ]);
    $sdk->reception->holidays->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/holidays$#',
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
          "start_date": {
              "year": 2026,
              "month": 1,
              "day": 1
          },
          "end_date": {
              "year": 2026,
              "month": 1,
              "day": 1
          },
          "holiday_type": "closed",
          "override_hours": [
              {
                  "start_hour": 0,
                  "start_minute": 0,
                  "end_hour": 0,
                  "end_minute": 0
              }
          ],
          "time_off_type": "staff",
          "resource_id": "test-value",
          "location_id": "test-value",
          "reason": "test-value",
          "id": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->holidays->get(
      request: new \ElevenLabs\Reception\Holidays\Requests\GetHolidaysRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ]),
      holidayId: 'holiday_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/holidays/[^/]+$#',
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
          "start_date": {
              "year": 2026,
              "month": 1,
              "day": 1
          },
          "end_date": {
              "year": 2026,
              "month": 1,
              "day": 1
          },
          "holiday_type": "closed",
          "override_hours": [
              {
                  "start_hour": 0,
                  "start_minute": 0,
                  "end_hour": 0,
                  "end_minute": 0
              }
          ],
          "time_off_type": "staff",
          "resource_id": "test-value",
          "location_id": "test-value",
          "reason": "test-value",
          "id": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $dateModel = new \ElevenLabs\Types\DateModel([
      'year' => 2026,
      'month' => 12,
      'day' => 25
    ]);

    $holidayType = \ElevenLabs\Types\HolidayType::Closed->value;

    $timeRangeModel = new \ElevenLabs\Types\TimeRangeModel([
      'startHour' => 9,
      'startMinute' => 8,
      'endHour' => 17,
      'endMinute' => 30
    ]);

    $timeOffType = \ElevenLabs\Types\TimeOffType::Staff->value;

    $request = new \ElevenLabs\Reception\Holidays\Requests\ReceptionUpdateHolidayRequestPatch([
      'xiWorkspaceId' => 'xi-workspace-id',
      'name' => 'Christmas Eve',
      'startDate' => $dateModel,
      'endDate' => $dateModel,
      'holidayType' => $holidayType,
      'overrideHours' => [],
      'timeOffType' => $timeOffType,
      'resourceId' => 'resource_id',
      'locationId' => 'location_id',
      'reason' => 'reason'
    ]);
    $sdk->reception->holidays->update(
      request: $request,
      holidayId: 'holiday_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PUT', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/holidays/[^/]+$#',
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
    $sdk->reception->holidays->delete(
      request: new \ElevenLabs\Reception\Holidays\Requests\DeleteHolidaysRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ]),
      holidayId: 'holiday_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/holidays/[^/]+$#',
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

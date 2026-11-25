<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\Staff;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class StaffWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      [
          {
              "groups": [
                  {
                      "label": "test-value",
                      "rank": 0
                  }
              ],
              "ungrouped_rank": 0,
              "name": "test-value",
              "description": "test-value",
              "is_active": true,
              "email": "test-value",
              "phone": "test-value",
              "sms_notifications_opted_in": true,
              "photo_url": "test-value",
              "location_id": "test-value",
              "working_hours": {
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
              "display_on_booking_page": true,
              "customer_facing_name": "test-value",
              "id": "test-value",
              "created_at_unix": 1,
              "updated_at_unix": 1
          }
      ]
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->staff->list(
      request: new \ElevenLabs\Reception\Staff\Requests\ListStaffRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/staff$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "groups": [
              {
                  "label": "test-value",
                  "rank": 0
              }
          ],
          "ungrouped_rank": 0,
          "name": "test-value",
          "description": "test-value",
          "is_active": true,
          "email": "test-value",
          "phone": "test-value",
          "sms_notifications_opted_in": true,
          "photo_url": "test-value",
          "location_id": "test-value",
          "working_hours": {
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
          "display_on_booking_page": true,
          "customer_facing_name": "test-value",
          "id": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $receptionGroupMembership = new \ElevenLabs\Types\ReceptionGroupMembership([
      'label' => 'in aute rep',
      'rank' => 10
    ]);

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

    $request = new \ElevenLabs\Reception\Staff\Requests\ReceptionCreateStaffRequest([
      'xiWorkspaceId' => 'xi-workspace-id',
      'groups' => [],
      'ungroupedRank' => 1,
      'name' => 'officia in',
      'description' => 'nisised in',
      'isActive' => true,
      'email' => 'jane@example.com',
      'phone' => 'commodo aute mo',
      'smsNotificationsOptedIn' => true,
      'photoUrl' => 'https://male-coal.com/',
      'locationId' => 'location_id',
      'workingHours' => $workingHours,
      'displayOnBookingPage' => true,
      'customerFacingName' => 'aute occaecat '
    ]);
    $sdk->reception->staff->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/staff$#',
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
          "groups": [
              {
                  "label": "test-value",
                  "rank": 0
              }
          ],
          "ungrouped_rank": 0,
          "name": "test-value",
          "description": "test-value",
          "is_active": true,
          "email": "test-value",
          "phone": "test-value",
          "sms_notifications_opted_in": true,
          "photo_url": "test-value",
          "location_id": "test-value",
          "working_hours": {
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
          "display_on_booking_page": true,
          "customer_facing_name": "test-value",
          "id": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->staff->get(
      request: new \ElevenLabs\Reception\Staff\Requests\GetStaffRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ]),
      staffId: 'staff_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/staff/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "groups": [
              {
                  "label": "test-value",
                  "rank": 0
              }
          ],
          "ungrouped_rank": 0,
          "name": "test-value",
          "description": "test-value",
          "is_active": true,
          "email": "test-value",
          "phone": "test-value",
          "sms_notifications_opted_in": true,
          "photo_url": "test-value",
          "location_id": "test-value",
          "working_hours": {
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
          "display_on_booking_page": true,
          "customer_facing_name": "test-value",
          "id": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $receptionGroupMembership = new \ElevenLabs\Types\ReceptionGroupMembership([
      'label' => 'in aute rep',
      'rank' => 10
    ]);

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

    $request = new \ElevenLabs\Reception\Staff\Requests\ReceptionUpdateStaffRequestPatch([
      'xiWorkspaceId' => 'xi-workspace-id',
      'groups' => [],
      'ungroupedRank' => 2,
      'name' => 'enim incididu',
      'description' => 'enim ipsum E',
      'isActive' => true,
      'email' => 'jane@example.com',
      'phone' => 'in aliquip ea e',
      'smsNotificationsOptedIn' => true,
      'photoUrl' => 'https://male-coal.com/',
      'locationId' => 'location_id',
      'workingHours' => $workingHours,
      'displayOnBookingPage' => false,
      'customerFacingName' => 'enim '
    ]);
    $sdk->reception->staff->update(
      request: $request,
      staffId: 'staff_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PUT', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/staff/[^/]+$#',
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
    $sdk->reception->staff->delete(
      request: new \ElevenLabs\Reception\Staff\Requests\DeleteStaffRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ]),
      staffId: 'staff_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/staff/[^/]+$#',
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

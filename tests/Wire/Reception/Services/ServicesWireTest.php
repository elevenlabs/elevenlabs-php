<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\Services;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ServicesWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      [
          {
              "pricing_mode": "fixed",
              "intake_questions": [
                  {
                      "id": "test-value",
                      "label": "test-value",
                      "kind": "text",
                      "options": [
                          "test-value"
                      ],
                      "required": true,
                      "is_active": true
                  }
              ],
              "groups": [
                  {
                      "label": "test-value",
                      "rank": 0
                  }
              ],
              "ungrouped_rank": 0,
              "name": "test-value",
              "description": "test-value",
              "variants": [
                  {
                      "id": "test-value",
                      "duration_minutes": 43200,
                      "price": 0,
                      "is_active": true
                  }
              ],
              "kind": "classic",
              "buffer_minutes": 0,
              "service_location": "business",
              "add_ons": [
                  {
                      "id": "test-value",
                      "name": "test-value",
                      "description": "test-value",
                      "add_duration_minutes": 0,
                      "add_price": 0
                  }
              ],
              "max_participants": 2,
              "capacity": 1,
              "is_active": true,
              "any_staff_member": true,
              "staff_ids": [
                  "test-value"
              ],
              "asset_ids": [
                  "test-value"
              ],
              "advance_booking_minutes": 0,
              "location_ids": [
                  "test-value"
              ],
              "display_on_booking_page": true,
              "travel_minutes": 0,
              "travel_before": true,
              "travel_after": true,
              "promotions": [
                  {
                      "id": "test-value",
                      "name": "test-value",
                      "target": "service",
                      "variant_id": "test-value",
                      "add_on_id": "test-value",
                      "promotional_price": 0,
                      "days_of_week": [
                          0
                      ],
                      "start_date": "test-value",
                      "end_date": "test-value",
                      "is_active": true
                  }
              ],
              "id": "test-value",
              "created_at_unix": 1,
              "updated_at_unix": 1,
              "duration_minutes": 1,
              "price": 1
          }
      ]
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $kind = \ElevenLabs\Types\ReceptionServiceKind::Classic;
    $sdk->reception->services->list(
      request: new \ElevenLabs\Reception\Services\Requests\ListServicesRequest([
        'staffId' => 'staff_id',
        'assetId' => 'asset_id',
        'isActive' => false,
        'kind' => $kind->value,
        'xiWorkspaceId' => 'xi-workspace-id'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/services$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "pricing_mode": "fixed",
          "intake_questions": [
              {
                  "id": "test-value",
                  "label": "test-value",
                  "kind": "text",
                  "options": [
                      "test-value"
                  ],
                  "required": true,
                  "is_active": true
              }
          ],
          "groups": [
              {
                  "label": "test-value",
                  "rank": 0
              }
          ],
          "ungrouped_rank": 0,
          "name": "test-value",
          "description": "test-value",
          "variants": [
              {
                  "id": "test-value",
                  "duration_minutes": 43200,
                  "price": 0,
                  "is_active": true
              }
          ],
          "kind": "classic",
          "buffer_minutes": 0,
          "service_location": "business",
          "add_ons": [
              {
                  "id": "test-value",
                  "name": "test-value",
                  "description": "test-value",
                  "add_duration_minutes": 0,
                  "add_price": 0
              }
          ],
          "max_participants": 2,
          "capacity": 1,
          "is_active": true,
          "any_staff_member": true,
          "staff_ids": [
              "test-value"
          ],
          "asset_ids": [
              "test-value"
          ],
          "advance_booking_minutes": 0,
          "location_ids": [
              "test-value"
          ],
          "display_on_booking_page": true,
          "travel_minutes": 0,
          "travel_before": true,
          "travel_after": true,
          "promotions": [
              {
                  "id": "test-value",
                  "name": "test-value",
                  "target": "service",
                  "variant_id": "test-value",
                  "add_on_id": "test-value",
                  "promotional_price": 0,
                  "days_of_week": [
                      0
                  ],
                  "start_date": "test-value",
                  "end_date": "test-value",
                  "is_active": true
              }
          ],
          "id": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1,
          "duration_minutes": 1,
          "price": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $pricingMode = \ElevenLabs\Types\PricingMode::Fixed->value;

    $intakeQuestionKind = \ElevenLabs\Types\IntakeQuestionKind::Text->value;

    $receptionIntakeQuestion = new \ElevenLabs\Types\ReceptionIntakeQuestion([
      'id' => 'intakeq_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      'label' => 'sed enim quis v',
      'kind' => $intakeQuestionKind,
      'options' => [],
      'required' => true,
      'isActive' => true
    ]);

    $receptionGroupMembership = new \ElevenLabs\Types\ReceptionGroupMembership([
      'label' => 'in aute rep',
      'rank' => 10
    ]);

    $receptionServiceVariant = new \ElevenLabs\Types\ReceptionServiceVariant([
      'id' => 'variant_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      'durationMinutes' => 60,
      'price' => 0.36,
      'isActive' => true
    ]);

    $receptionServiceKind = \ElevenLabs\Types\ReceptionServiceKind::Classic->value;

    $serviceLocationType = \ElevenLabs\Types\ServiceLocationType::Business->value;

    $receptionAddOn = new \ElevenLabs\Types\ReceptionAddOn([
      'id' => 'addon_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      'name' => 'dolor culpa',
      'description' => 'sed quis',
      'addDurationMinutes' => 10,
      'addPrice' => 5
    ]);

    $promotionTarget = \ElevenLabs\Types\PromotionTarget::Service->value;

    $receptionServicePromotion = new \ElevenLabs\Types\ReceptionServicePromotion([
      'id' => 'promo_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      'name' => 'esseincididu',
      'target' => $promotionTarget,
      'variantId' => 'variant_id',
      'addOnId' => 'add_on_id',
      'promotionalPrice' => 35,
      'daysOfWeek' => [],
      'startDate' => '2026-12-01',
      'endDate' => '2026-12-31',
      'isActive' => true
    ]);

    $request = new \ElevenLabs\Reception\Services\Requests\ReceptionCreateServiceRequest([
      'xiWorkspaceId' => 'xi-workspace-id',
      'pricingMode' => $pricingMode,
      'intakeQuestions' => [],
      'groups' => [],
      'ungroupedRank' => 6,
      'name' => 'id adi',
      'description' => 'irure',
      'variants' => [$receptionServiceVariant],
      'kind' => $receptionServiceKind,
      'bufferMinutes' => 15,
      'serviceLocation' => $serviceLocationType,
      'addOns' => [],
      'maxParticipants' => 23,
      'capacity' => 8,
      'isActive' => true,
      'anyStaffMember' => true,
      'staffIds' => [],
      'assetIds' => [],
      'advanceBookingMinutes' => 10080,
      'locationIds' => [],
      'displayOnBookingPage' => true,
      'travelMinutes' => 15,
      'travelBefore' => true,
      'travelAfter' => true,
      'promotions' => []
    ]);
    $sdk->reception->services->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/services$#',
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
          "pricing_mode": "fixed",
          "intake_questions": [
              {
                  "id": "test-value",
                  "label": "test-value",
                  "kind": "text",
                  "options": [
                      "test-value"
                  ],
                  "required": true,
                  "is_active": true
              }
          ],
          "groups": [
              {
                  "label": "test-value",
                  "rank": 0
              }
          ],
          "ungrouped_rank": 0,
          "name": "test-value",
          "description": "test-value",
          "variants": [
              {
                  "id": "test-value",
                  "duration_minutes": 43200,
                  "price": 0,
                  "is_active": true
              }
          ],
          "kind": "classic",
          "buffer_minutes": 0,
          "service_location": "business",
          "add_ons": [
              {
                  "id": "test-value",
                  "name": "test-value",
                  "description": "test-value",
                  "add_duration_minutes": 0,
                  "add_price": 0
              }
          ],
          "max_participants": 2,
          "capacity": 1,
          "is_active": true,
          "any_staff_member": true,
          "staff_ids": [
              "test-value"
          ],
          "asset_ids": [
              "test-value"
          ],
          "advance_booking_minutes": 0,
          "location_ids": [
              "test-value"
          ],
          "display_on_booking_page": true,
          "travel_minutes": 0,
          "travel_before": true,
          "travel_after": true,
          "promotions": [
              {
                  "id": "test-value",
                  "name": "test-value",
                  "target": "service",
                  "variant_id": "test-value",
                  "add_on_id": "test-value",
                  "promotional_price": 0,
                  "days_of_week": [
                      0
                  ],
                  "start_date": "test-value",
                  "end_date": "test-value",
                  "is_active": true
              }
          ],
          "id": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1,
          "duration_minutes": 1,
          "price": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->services->get(
      request: new \ElevenLabs\Reception\Services\Requests\GetServicesRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ]),
      serviceId: 'service_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/services/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "service": {
              "pricing_mode": "fixed",
              "intake_questions": [
                  {
                      "id": "test-value",
                      "label": "test-value",
                      "kind": "text",
                      "options": [
                          "test-value"
                      ],
                      "required": true,
                      "is_active": true
                  }
              ],
              "groups": [
                  {
                      "label": "test-value",
                      "rank": 0
                  }
              ],
              "ungrouped_rank": 0,
              "name": "test-value",
              "description": "test-value",
              "variants": [
                  {
                      "id": "test-value",
                      "duration_minutes": 43200,
                      "price": 0,
                      "is_active": true
                  }
              ],
              "kind": "classic",
              "buffer_minutes": 0,
              "service_location": "business",
              "add_ons": [
                  {
                      "id": "test-value",
                      "name": "test-value",
                      "description": "test-value",
                      "add_duration_minutes": 0,
                      "add_price": 0
                  }
              ],
              "max_participants": 2,
              "capacity": 1,
              "is_active": true,
              "any_staff_member": true,
              "staff_ids": [
                  "test-value"
              ],
              "asset_ids": [
                  "test-value"
              ],
              "advance_booking_minutes": 0,
              "location_ids": [
                  "test-value"
              ],
              "display_on_booking_page": true,
              "travel_minutes": 0,
              "travel_before": true,
              "travel_after": true,
              "promotions": [
                  {
                      "id": "test-value",
                      "name": "test-value",
                      "target": "service",
                      "variant_id": "test-value",
                      "add_on_id": "test-value",
                      "promotional_price": 0,
                      "days_of_week": [
                          0
                      ],
                      "start_date": "test-value",
                      "end_date": "test-value",
                      "is_active": true
                  }
              ],
              "id": "test-value",
              "created_at_unix": 1,
              "updated_at_unix": 1,
              "duration_minutes": 1,
              "price": 1
          },
          "has_affected_events": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $pricingMode = \ElevenLabs\Types\PricingMode::Fixed->value;

    $intakeQuestionKind = \ElevenLabs\Types\IntakeQuestionKind::Text->value;

    $receptionIntakeQuestion = new \ElevenLabs\Types\ReceptionIntakeQuestion([
      'id' => 'intakeq_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      'label' => 'sed enim quis v',
      'kind' => $intakeQuestionKind,
      'options' => [],
      'required' => true,
      'isActive' => true
    ]);

    $receptionGroupMembership = new \ElevenLabs\Types\ReceptionGroupMembership([
      'label' => 'in aute rep',
      'rank' => 10
    ]);

    $receptionServiceVariant = new \ElevenLabs\Types\ReceptionServiceVariant([
      'id' => 'variant_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      'durationMinutes' => 60,
      'price' => 0.36,
      'isActive' => true
    ]);

    $receptionServiceKind = \ElevenLabs\Types\ReceptionServiceKind::Classic->value;

    $serviceLocationType = \ElevenLabs\Types\ServiceLocationType::Business->value;

    $receptionAddOn = new \ElevenLabs\Types\ReceptionAddOn([
      'id' => 'addon_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      'name' => 'dolor culpa',
      'description' => 'sed quis',
      'addDurationMinutes' => 10,
      'addPrice' => 5
    ]);

    $promotionTarget = \ElevenLabs\Types\PromotionTarget::Service->value;

    $receptionServicePromotion = new \ElevenLabs\Types\ReceptionServicePromotion([
      'id' => 'promo_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      'name' => 'esseincididu',
      'target' => $promotionTarget,
      'variantId' => 'variant_id',
      'addOnId' => 'add_on_id',
      'promotionalPrice' => 35,
      'daysOfWeek' => [],
      'startDate' => '2026-12-01',
      'endDate' => '2026-12-31',
      'isActive' => true
    ]);

    $request = new \ElevenLabs\Reception\Services\Requests\ReceptionUpdateServiceRequestPatch([
      'xiWorkspaceId' => 'xi-workspace-id',
      'pricingMode' => $pricingMode,
      'intakeQuestions' => [],
      'groups' => [],
      'ungroupedRank' => 3,
      'name' => 'nisi adi',
      'description' => 'laboris culpa',
      'variants' => [],
      'kind' => $receptionServiceKind,
      'bufferMinutes' => 15,
      'serviceLocation' => $serviceLocationType,
      'addOns' => [],
      'maxParticipants' => 86,
      'capacity' => 5,
      'isActive' => true,
      'anyStaffMember' => false,
      'staffIds' => [],
      'assetIds' => [],
      'advanceBookingMinutes' => 10080,
      'locationIds' => [],
      'displayOnBookingPage' => false,
      'travelMinutes' => 15,
      'travelBefore' => false,
      'travelAfter' => false,
      'promotions' => [],
      'durationMinutes' => 40521,
      'price' => 7.02
    ]);
    $sdk->reception->services->update(
      request: $request,
      serviceId: 'service_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PUT', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/services/[^/]+$#',
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
    $sdk->reception->services->delete(
      request: new \ElevenLabs\Reception\Services\Requests\DeleteServicesRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ]),
      serviceId: 'service_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/services/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testConfirmUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "service": {
              "pricing_mode": "fixed",
              "intake_questions": [
                  {
                      "id": "test-value",
                      "label": "test-value",
                      "kind": "text",
                      "options": [
                          "test-value"
                      ],
                      "required": true,
                      "is_active": true
                  }
              ],
              "groups": [
                  {
                      "label": "test-value",
                      "rank": 0
                  }
              ],
              "ungrouped_rank": 0,
              "name": "test-value",
              "description": "test-value",
              "variants": [
                  {
                      "id": "test-value",
                      "duration_minutes": 43200,
                      "price": 0,
                      "is_active": true
                  }
              ],
              "kind": "classic",
              "buffer_minutes": 0,
              "service_location": "business",
              "add_ons": [
                  {
                      "id": "test-value",
                      "name": "test-value",
                      "description": "test-value",
                      "add_duration_minutes": 0,
                      "add_price": 0
                  }
              ],
              "max_participants": 2,
              "capacity": 1,
              "is_active": true,
              "any_staff_member": true,
              "staff_ids": [
                  "test-value"
              ],
              "asset_ids": [
                  "test-value"
              ],
              "advance_booking_minutes": 0,
              "location_ids": [
                  "test-value"
              ],
              "display_on_booking_page": true,
              "travel_minutes": 0,
              "travel_before": true,
              "travel_after": true,
              "promotions": [
                  {
                      "id": "test-value",
                      "name": "test-value",
                      "target": "service",
                      "variant_id": "test-value",
                      "add_on_id": "test-value",
                      "promotional_price": 0,
                      "days_of_week": [
                          0
                      ],
                      "start_date": "test-value",
                      "end_date": "test-value",
                      "is_active": true
                  }
              ],
              "id": "test-value",
              "created_at_unix": 1,
              "updated_at_unix": 1,
              "duration_minutes": 1,
              "price": 1
          },
          "has_affected_events": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $pricingMode = \ElevenLabs\Types\PricingMode::Fixed->value;

    $intakeQuestionKind = \ElevenLabs\Types\IntakeQuestionKind::Text->value;

    $receptionIntakeQuestion = new \ElevenLabs\Types\ReceptionIntakeQuestion([
      'id' => 'intakeq_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      'label' => 'sed enim quis v',
      'kind' => $intakeQuestionKind,
      'options' => [],
      'required' => true,
      'isActive' => true
    ]);

    $receptionGroupMembership = new \ElevenLabs\Types\ReceptionGroupMembership([
      'label' => 'in aute rep',
      'rank' => 10
    ]);

    $receptionServiceVariant = new \ElevenLabs\Types\ReceptionServiceVariant([
      'id' => 'variant_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      'durationMinutes' => 60,
      'price' => 0.36,
      'isActive' => true
    ]);

    $receptionServiceKind = \ElevenLabs\Types\ReceptionServiceKind::Classic->value;

    $serviceLocationType = \ElevenLabs\Types\ServiceLocationType::Business->value;

    $receptionAddOn = new \ElevenLabs\Types\ReceptionAddOn([
      'id' => 'addon_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      'name' => 'dolor culpa',
      'description' => 'sed quis',
      'addDurationMinutes' => 10,
      'addPrice' => 5
    ]);

    $promotionTarget = \ElevenLabs\Types\PromotionTarget::Service->value;

    $receptionServicePromotion = new \ElevenLabs\Types\ReceptionServicePromotion([
      'id' => 'promo_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      'name' => 'esseincididu',
      'target' => $promotionTarget,
      'variantId' => 'variant_id',
      'addOnId' => 'add_on_id',
      'promotionalPrice' => 35,
      'daysOfWeek' => [],
      'startDate' => '2026-12-01',
      'endDate' => '2026-12-31',
      'isActive' => true
    ]);

    $request = new \ElevenLabs\Reception\Services\Requests\ReceptionConfirmServiceUpdateRequest([
      'reprice' => true,
      'xiWorkspaceId' => 'xi-workspace-id',
      'pricingMode' => $pricingMode,
      'intakeQuestions' => [],
      'groups' => [],
      'ungroupedRank' => 1,
      'name' => 'venia',
      'description' => 'sint nostrud',
      'variants' => [],
      'kind' => $receptionServiceKind,
      'bufferMinutes' => 15,
      'serviceLocation' => $serviceLocationType,
      'addOns' => [],
      'maxParticipants' => 158,
      'capacity' => 9,
      'isActive' => false,
      'anyStaffMember' => true,
      'staffIds' => [],
      'assetIds' => [],
      'advanceBookingMinutes' => 10080,
      'locationIds' => [],
      'displayOnBookingPage' => false,
      'travelMinutes' => 15,
      'travelBefore' => false,
      'travelAfter' => false,
      'promotions' => [],
      'durationMinutes' => 4182,
      'price' => 7.94
    ]);
    $sdk->reception->services->confirmUpdate(
      request: $request,
      serviceId: 'service_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/services/[^/]+/confirm-update$#',
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

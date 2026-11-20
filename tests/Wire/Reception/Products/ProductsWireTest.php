<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\Products;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ProductsWireTest extends TestCase
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
              "price": 0,
              "is_active": true,
              "orderable": true,
              "allowed_fulfillment_types": [
                  "pickup"
              ],
              "location_ids": [
                  "test-value"
              ],
              "stock": {
                  "key": 0
              },
              "id": "test-value",
              "created_at_unix": 1,
              "updated_at_unix": 1
          }
      ]
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->products->list(
      request: new \ElevenLabs\Reception\Products\Requests\ListProductsRequest([
        'group' => 'group',
        'isActive' => true,
        'xiWorkspaceId' => 'xi-workspace-id'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/products$#',
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
          "price": 0,
          "is_active": true,
          "orderable": true,
          "allowed_fulfillment_types": [
              "pickup"
          ],
          "location_ids": [
              "test-value"
          ],
          "stock": {
              "key": 0
          },
          "id": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $pricingMode = \ElevenLabs\Types\PricingMode::Fixed->value;

    $intakeQuestionKind = \ElevenLabs\Types\IntakeQuestionKind::Text->value;

    $receptionIntakeQuestion = new \ElevenLabs\Types\ReceptionIntakeQuestion([
      'id' => 'intakeq_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      'label' => 'est ci',
      'kind' => $intakeQuestionKind,
      'options' => [],
      'required' => true,
      'isActive' => true
    ]);

    $receptionGroupMembership = new \ElevenLabs\Types\ReceptionGroupMembership([
      'label' => 'dolore dolor ',
      'rank' => 0
    ]);

    $orderFulfillmentType = \ElevenLabs\Types\OrderFulfillmentType::Pickup->value;

    $request = new \ElevenLabs\Reception\Products\Requests\ReceptionCreateProductRequest([
      'xiWorkspaceId' => 'xi-workspace-id',
      'pricingMode' => $pricingMode,
      'intakeQuestions' => [],
      'groups' => [],
      'ungroupedRank' => 2,
      'name' => 'veniam',
      'description' => 'et sin',
      'price' => 0.48,
      'isActive' => true,
      'orderable' => true,
      'allowedFulfillmentTypes' => [],
      'locationIds' => [],
      'trackQuantity' => true
    ]);
    $sdk->reception->products->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/products$#',
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
          "price": 0,
          "is_active": true,
          "orderable": true,
          "allowed_fulfillment_types": [
              "pickup"
          ],
          "location_ids": [
              "test-value"
          ],
          "stock": {
              "key": 0
          },
          "id": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->reception->products->get(
      request: new \ElevenLabs\Reception\Products\Requests\GetProductsRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ]),
      productId: 'product_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/products/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
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
          "price": 0,
          "is_active": true,
          "orderable": true,
          "allowed_fulfillment_types": [
              "pickup"
          ],
          "location_ids": [
              "test-value"
          ],
          "stock": {
              "key": 0
          },
          "id": "test-value",
          "created_at_unix": 1,
          "updated_at_unix": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $pricingMode = \ElevenLabs\Types\PricingMode::Fixed->value;

    $intakeQuestionKind = \ElevenLabs\Types\IntakeQuestionKind::Text->value;

    $receptionIntakeQuestion = new \ElevenLabs\Types\ReceptionIntakeQuestion([
      'id' => 'intakeq_4801jx8k3m5n7p9q2r4s6t8v0w2y',
      'label' => 'est ci',
      'kind' => $intakeQuestionKind,
      'options' => [],
      'required' => true,
      'isActive' => true
    ]);

    $receptionGroupMembership = new \ElevenLabs\Types\ReceptionGroupMembership([
      'label' => 'dolore dolor ',
      'rank' => 0
    ]);

    $orderFulfillmentType = \ElevenLabs\Types\OrderFulfillmentType::Pickup->value;

    $request = new \ElevenLabs\Reception\Products\Requests\ReceptionUpdateProductRequestPatch([
      'xiWorkspaceId' => 'xi-workspace-id',
      'pricingMode' => $pricingMode,
      'intakeQuestions' => [],
      'groups' => [],
      'ungroupedRank' => 2,
      'name' => 'adipisicing',
      'description' => 'in dolor e',
      'price' => 6.98,
      'isActive' => true,
      'orderable' => true,
      'allowedFulfillmentTypes' => [],
      'locationIds' => [],
      'trackQuantity' => false
    ]);
    $sdk->reception->products->update(
      request: $request,
      productId: 'product_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PUT', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/products/[^/]+$#',
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
    $sdk->reception->products->delete(
      request: new \ElevenLabs\Reception\Products\Requests\DeleteProductsRequest([
        'xiWorkspaceId' => 'xi-workspace-id'
      ]),
      productId: 'product_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/products/[^/]+$#',
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

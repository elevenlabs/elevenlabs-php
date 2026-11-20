<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Reception\Products\Stock;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class StockWireTest extends TestCase
{
  public function testSetSendsWireRequest(): void
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

    $request = new \ElevenLabs\Reception\Products\Stock\Requests\ReceptionUpdateProductStockRequest(
      [
        'xiWorkspaceId' => 'xi-workspace-id',
        'locationId' => 'location_4801jx8k3m5n7p9q2r4s6t8v0w2y',
        'onHand' => 24,
        'expectedOnHand' => 25
      ]
    );
    $sdk->reception->products->stock->set(
      request: $request,
      productId: 'product_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/products/[^/]+/stock$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testAdjustSendsWireRequest(): void
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

    $request = new \ElevenLabs\Reception\Products\Stock\Requests\ReceptionAdjustProductStockRequest(
      [
        'xiWorkspaceId' => 'xi-workspace-id',
        'locationId' => 'location_4801jx8k3m5n7p9q2r4s6t8v0w2y',
        'delta' => -2
      ]
    );
    $sdk->reception->products->stock->adjust(
      request: $request,
      productId: 'product_4801jx8k3m5n7p9q2r4s6t8v0w2y'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/reception/products/[^/]+/stock/adjust$#',
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

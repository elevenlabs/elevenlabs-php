<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Productions\Orders;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class OrdersWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "orders": [
              {
                  "order_id": "test-value",
                  "name": "test-value",
                  "state": "open",
                  "total_amount_usd": 1,
                  "sandbox": true,
                  "submitted_at": "2023-01-01T12:34:56Z",
                  "updated_at": "2023-01-01T12:34:56Z",
                  "cancel_reason": "test-value"
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->productions->orders->list(
      request: new \ElevenLabs\Productions\Orders\Requests\ListOrdersRequest([
        'pageSize' => 20,
        'offset' => 10,
        'status' => [],
        'startDate' => new \DateTime('2023-07-20T21:03:51.582Z'),
        'endDate' => new \DateTime('2023-07-20T21:03:51.582Z')
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/productions/orders$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "order_id": "test-value",
          "sandbox": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Types\CreateOrderRequest([
      'sandbox' => true
    ]);
    $sdk->productions->orders->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/productions/orders$#',
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
          "order_id": "test-value",
          "name": "test-value",
          "state": "open",
          "items": [
              {
                  "item_id": "test-value",
                  "item": {
                      "kind": "dub",
                      "media_id": "test-value",
                      "source_language": "test-value",
                      "destination_languages": [
                          "test-value"
                      ],
                      "include_captions": true,
                      "include_source_captions": true,
                      "instructions": "test-value",
                      "captions_sdh": true
                  },
                  "quote": {
                      "amount_usd": 1
                  }
              }
          ],
          "total_amount_usd": 1,
          "sandbox": true,
          "created_at": "2023-01-01T12:34:56Z",
          "submitted_at": "2023-01-01T12:34:56Z",
          "paid_at": "2023-01-01T12:34:56Z",
          "accepted_at": "2023-01-01T12:34:56Z",
          "completed_at": "2023-01-01T12:34:56Z",
          "cancel_reason": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->productions->orders->get(orderId: 'prodorder_obof4bec8msxt6qz46ok5fhzo2');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/productions/orders/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "name": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $updateOrderRequest = new \ElevenLabs\Types\UpdateOrderRequest([
      'name' => 'name'
    ]);

    $request = new \ElevenLabs\Productions\Orders\Requests\BodyUpdateOrderV1ProductionsOrdersOrderIdPatch(
      [
        'request' => $updateOrderRequest
      ]
    );
    $sdk->productions->orders->update(
      request: $request,
      orderId: 'prodorder_6c7w0takk14ey46ea22h7agqqm'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/productions/orders/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testSubmitSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "order_id": "test-value",
          "state": "open",
          "submitted_at": "2023-01-01T12:34:56Z"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->productions->orders->submit(orderId: 'prodorder_xkxpu9nsh2o0ihren6kh2cozml');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/productions/orders/[^/]+/submit$#',
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

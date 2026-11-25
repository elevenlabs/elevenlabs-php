<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Productions\Orders\Items;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ItemsWireTest extends TestCase
{
  public function testUpsertSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "item_id": "test-value",
          "quote": {
              "amount_usd": 1
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $dubOrderItemRequestKind = \ElevenLabs\Types\DubOrderItemRequestKind::Dub->value;

    $dubOrderItemRequest = new \ElevenLabs\Types\DubOrderItemRequest([
      'kind' => $dubOrderItemRequestKind,
      'mediaId' => 'prodmedia_dw4j9zzcgpl3ovy2piv18dray9',
      'sourceLanguage' => 'source_language',
      'destinationLanguages' => [],
      'includeCaptions' => false,
      'includeSourceCaptions' => true,
      'instructions' => 'instructions',
      'captionsSdh' => true
    ]);
    $orderItemRequestInput = \ElevenLabs\Types\OrderItemRequestInput::dub($dubOrderItemRequest);

    $upsertOrderItemRequest = new \ElevenLabs\Types\UpsertOrderItemRequest([
      'item' => $orderItemRequestInput,
      'itemId' => 'proditem_m9abnacd1yjnvg5xlm727mbbxw'
    ]);

    $request = new \ElevenLabs\Productions\Orders\Items\Requests\BodyUpsertOrderItemV1ProductionsOrdersOrderIdItemsPost(
      [
        'request' => $upsertOrderItemRequest
      ]
    );
    $sdk->productions->orders->items->upsert(
      request: $request,
      orderId: 'prodorder_w6oaxf9gz3cnnuplz2mxa8iaw5'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/productions/orders/[^/]+/items$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testRemoveSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "success": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->productions->orders->items->remove(
      orderId: 'prodorder_wvf21lwlhim1dh7g4qha3j4sfq',
      itemId: 'proditem_d93pceng4xt3egvw2g8mbcluxw'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/productions/orders/[^/]+/items/[^/]+$#',
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

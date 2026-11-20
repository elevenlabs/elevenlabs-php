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
      'mediaId' => 'prodmedia_wum7qohp42vqjk180vfetxnfh6',
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
      'itemId' => 'proditem_dh7g4qha3j4sfqyd93pceng4xt'
    ]);

    $request = new \ElevenLabs\Productions\Orders\Items\Requests\BodyUpsertOrderItemV1ProductionsOrdersOrderIdItemsPost(
      [
        'request' => $upsertOrderItemRequest
      ]
    );
    $sdk->productions->orders->items->upsert(
      request: $request,
      orderId: 'prodorder_8zubn7rexrwpqq6wvf21lwlhim'
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
      orderId: 'prodorder_0ihren6kh2cozmla7zbrytxvsp',
      itemId: 'proditem_0zaouovm1tk2ia6vh8jlaex67t'
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

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Voices\Collections;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class CollectionsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "collections": [
              {
                  "collection_id": "test-value",
                  "title": "test-value",
                  "icon": "test-value",
                  "permission_on_resource": "admin"
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->voices->collections->list();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/collections$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "collection_id": "test-value",
          "title": "test-value",
          "icon": "test-value",
          "permission_on_resource": "admin"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Voices\Collections\Requests\BodyCreateVoiceCollectionV1VoicesCollectionsPost(
      [
        'title' => 'title',
        'icon' => 'icon'
      ]
    );
    $sdk->voices->collections->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/collections$#',
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
          "collection_id": "test-value",
          "title": "test-value",
          "icon": "test-value",
          "permission_on_resource": "admin"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->voices->collections->get(collectionId: 'collection_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/collections/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "collection_id": "test-value",
          "title": "test-value",
          "icon": "test-value",
          "permission_on_resource": "admin"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Voices\Collections\Requests\BodyUpdateVoiceCollectionV1VoicesCollectionsCollectionIdPatch(
      [
        'title' => 'title',
        'icon' => 'icon'
      ]
    );
    $sdk->voices->collections->update(request: $request, collectionId: 'collection_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/collections/[^/]+$#',
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
          "collection_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->voices->collections->delete(collectionId: 'collection_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/collections/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testAddVoiceSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "collection_id": "test-value",
          "voice_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->voices->collections->addVoice(
      collectionId: 'collection_id',
      voiceId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/collections/[^/]+/voice/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testRemoveVoiceSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "collection_id": "test-value",
          "voice_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->voices->collections->removeVoice(
      collectionId: 'collection_id',
      voiceId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/collections/[^/]+/voice/[^/]+$#',
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

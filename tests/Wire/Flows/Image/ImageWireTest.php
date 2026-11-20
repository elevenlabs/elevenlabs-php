<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Flows\Image;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ImageWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "generations": [
              {
                  "id": "test-value",
                  "status": "pending"
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $status = \ElevenLabs\Flows\Image\Types\ListImageRequestStatus::Pending;
    $sdk->flows->image->list(
      request: new \ElevenLabs\Flows\Image\Requests\ListImageRequest([
        'cursor' => 'cursor',
        'pageSize' => 30,
        'status' => $status->value,
        'modelId' => 'model_id'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/flows/image$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "status": "pending"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $webhookTargetAllType = \ElevenLabs\Types\WebhookTargetAllType::All->value;

    $webhookTargetAll = new \ElevenLabs\Types\WebhookTargetAll([
      'type' => $webhookTargetAllType
    ]);
    $webhookTarget = \ElevenLabs\Types\WebhookTarget::all($webhookTargetAll);

    $generationReferenceType = \ElevenLabs\Types\GenerationReferenceType::Generation->value;

    $generationReference = new \ElevenLabs\Types\GenerationReference([
      'type' => $generationReferenceType,
      'generationId' => 'JWr5N6X9ZTqf8jD2LmQb'
    ]);
    $imageReference = \ElevenLabs\Types\ImageReference::generation($generationReference);

    $gptImage1RequestQuality = \ElevenLabs\Types\GptImage1RequestQuality::Low->value;

    $gptImage1RequestBackground = \ElevenLabs\Types\GptImage1RequestBackground::Transparent->value;

    $gptImage1RequestAspectRatio = \ElevenLabs\Types\GptImage1RequestAspectRatio::One1->value;

    $gptImage1RequestModelId = \ElevenLabs\Types\GptImage1RequestModelId::GptImage1->value;

    $request = new \ElevenLabs\Types\GptImage1Request([
      'webhook' => $webhookTarget,
      'prompt' =>
        'A corgi in a tiny lifeguard chair on a sunlit beach at golden hour, photorealistic',
      'images' => [],
      'mask' => $imageReference,
      'quality' => $gptImage1RequestQuality,
      'background' => $gptImage1RequestBackground,
      'aspectRatio' => $gptImage1RequestAspectRatio,
      'modelId' => $gptImage1RequestModelId
    ]);
    $sdk->flows->image->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/flows/image$#',
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
          "id": "test-value",
          "status": "pending"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->flows->image->get(generationId: 'generation_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/flows/image/[^/]+$#',
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

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Flows\Templates\Runs;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class RunsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "runs": [
              {
                  "id": "test-value",
                  "template_id": "test-value",
                  "version_id": "test-value",
                  "status": "pending",
                  "outputs": {
                      "key": {
                          "id": "test-value",
                          "status": "pending",
                          "failure_reason": "timeout",
                          "error_message": "test-value",
                          "content_url": "test-value",
                          "content_mime_type": "test-value",
                          "type": "image"
                      }
                  }
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->flows->templates->runs->list(
      request: new \ElevenLabs\Flows\Templates\Runs\Requests\ListRunsRequest([
        'cursor' => 'cursor',
        'pageSize' => 30,
        'versionId' => 'version_id'
      ]),
      templateId: 'template_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/flows/templates/[^/]+/runs$#',
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
          "template_id": "test-value",
          "version_id": "test-value",
          "status": "pending",
          "outputs": {
              "key": {
                  "id": "test-value",
                  "status": "pending",
                  "failure_reason": "timeout",
                  "error_message": "test-value",
                  "content_url": "test-value",
                  "content_mime_type": "test-value",
                  "type": "image"
              }
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $generationReferenceType = \ElevenLabs\Types\GenerationReferenceType::Generation->value;

    $generationReference = new \ElevenLabs\Types\GenerationReference([
      'type' => $generationReferenceType,
      'generationId' => 'JWr5N6X9ZTqf8jD2LmQb'
    ]);
    $templateInputReference = \ElevenLabs\Types\TemplateInputReference::generation(
      $generationReference
    );
    $templateRunInput = \ElevenLabs\Types\TemplateRunInput::fromMultiple([$templateInputReference]);

    $webhookTargetAllType = \ElevenLabs\Types\WebhookTargetAllType::All->value;

    $webhookTargetAll = new \ElevenLabs\Types\WebhookTargetAll([
      'type' => $webhookTargetAllType
    ]);
    $webhookTarget = \ElevenLabs\Types\WebhookTarget::all($webhookTargetAll);

    $request = new \ElevenLabs\Flows\Templates\Runs\Requests\TemplateRunCreateRequest([
      'inputs' => [],
      'versionId' => 'version_id',
      'webhook' => $webhookTarget
    ]);
    $sdk->flows->templates->runs->create(request: $request, templateId: 'template_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/flows/templates/[^/]+/runs$#',
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
          "template_id": "test-value",
          "version_id": "test-value",
          "status": "pending",
          "outputs": {
              "key": {
                  "id": "test-value",
                  "status": "pending",
                  "failure_reason": "timeout",
                  "error_message": "test-value",
                  "content_url": "test-value",
                  "content_mime_type": "test-value",
                  "type": "image"
              }
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->flows->templates->runs->get(templateId: 'template_id', runId: 'run_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/flows/templates/[^/]+/runs/[^/]+$#',
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

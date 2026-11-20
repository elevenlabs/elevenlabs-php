<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Flows\Templates;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class TemplatesWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "templates": [
              {
                  "id": "test-value",
                  "name": "test-value",
                  "description": "test-value",
                  "versions": [
                      {
                          "version_id": "test-value",
                          "published_at_unix": 1,
                          "is_latest": true,
                          "inputs": [
                              {
                                  "id": "test-value",
                                  "content_schema": {
                                      "title": "test-value",
                                      "description": "test-value",
                                      "type": "string",
                                      "enum": [
                                          "test-value"
                                      ]
                                  }
                              }
                          ],
                          "outputs": [
                              {
                                  "id": "test-value",
                                  "content_schema": {
                                      "title": "test-value",
                                      "description": "test-value",
                                      "type": "string",
                                      "enum": [
                                          "test-value"
                                      ]
                                  }
                              }
                          ]
                      }
                  ],
                  "has_more_versions": true
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->flows->templates->list(
      request: new \ElevenLabs\Flows\Templates\Requests\ListTemplatesRequest([
        'cursor' => 'cursor',
        'pageSize' => 10,
        'versionsPerTemplate' => 3,
        'search' => 'search'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/flows/templates$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "name": "test-value",
          "description": "test-value",
          "versions": [
              {
                  "version_id": "test-value",
                  "published_at_unix": 1,
                  "is_latest": true,
                  "inputs": [
                      {
                          "id": "test-value",
                          "content_schema": {
                              "title": "test-value",
                              "description": "test-value",
                              "type": "string",
                              "enum": [
                                  "test-value"
                              ]
                          }
                      }
                  ],
                  "outputs": [
                      {
                          "id": "test-value",
                          "content_schema": {
                              "title": "test-value",
                              "description": "test-value",
                              "type": "string",
                              "enum": [
                                  "test-value"
                              ]
                          }
                      }
                  ]
              }
          ],
          "has_more_versions": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->flows->templates->get(
      request: new \ElevenLabs\Flows\Templates\Requests\GetTemplatesRequest([
        'versionsPerTemplate' => 10
      ]),
      templateId: 'template_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/flows/templates/[^/]+$#',
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

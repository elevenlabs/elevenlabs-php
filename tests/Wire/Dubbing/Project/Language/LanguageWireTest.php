<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Dubbing\Project\Language;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class LanguageWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "languages": [
              {
                  "language_id": "test-value",
                  "project_id": "test-value",
                  "target_language": "test-value",
                  "status": "queued",
                  "model_id": "test-value",
                  "voice_settings": {
                      "cloning_strength": 0
                  },
                  "outputs": {
                      "lossless_audio": "test-value",
                      "subtitles": "test-value"
                  },
                  "revision": 1,
                  "output_revision": 1,
                  "error": {
                      "code": "test-value",
                      "message": "test-value",
                      "retryable": true
                  },
                  "warnings": [
                      {
                          "type": "voices_not_permitted",
                          "speaker_ids": [
                              "test-value"
                          ],
                          "message": "test-value"
                      }
                  ],
                  "created_at": "2023-01-01T12:34:56Z",
                  "updated_at": "2023-01-01T12:34:56Z"
              }
          ],
          "next_cursor": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->dubbing->project->language->list(
      request: new \ElevenLabs\Dubbing\Project\Language\Requests\ListLanguageRequest([
        'cursor' => 'cursor',
        'pageSize' => 20,
        'status' => 'status'
      ]),
      projectId: 'project_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/project/[^/]+/language$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      201,
      <<<'JSON'
      {
          "language_id": "test-value",
          "project_id": "test-value",
          "target_language": "test-value",
          "status": "queued",
          "model_id": "test-value",
          "voice_settings": {
              "cloning_strength": 0
          },
          "outputs": {
              "lossless_audio": "test-value",
              "subtitles": "test-value"
          },
          "revision": 1,
          "output_revision": 1,
          "error": {
              "code": "test-value",
              "message": "test-value",
              "retryable": true
          },
          "warnings": [
              {
                  "type": "voices_not_permitted",
                  "speaker_ids": [
                      "test-value"
                  ],
                  "message": "test-value"
              }
          ],
          "created_at": "2023-01-01T12:34:56Z",
          "updated_at": "2023-01-01T12:34:56Z"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $dubbingVoiceSettings = new \ElevenLabs\Types\DubbingVoiceSettings([
      'cloningStrength' => 7
    ]);

    $request = new \ElevenLabs\Dubbing\Project\Language\Requests\BodyCreateDubbingLanguageTargetV1DubbingProjectProjectIdLanguagePost(
      [
        'targetLanguage' => 'target_language',
        'voiceSettings' => $dubbingVoiceSettings,
        'translations' => []
      ]
    );
    $sdk->dubbing->project->language->create(request: $request, projectId: 'project_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/project/[^/]+/language$#',
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
          "language_id": "test-value",
          "project_id": "test-value",
          "target_language": "test-value",
          "status": "queued",
          "model_id": "test-value",
          "voice_settings": {
              "cloning_strength": 0
          },
          "outputs": {
              "lossless_audio": "test-value",
              "subtitles": "test-value"
          },
          "revision": 1,
          "output_revision": 1,
          "error": {
              "code": "test-value",
              "message": "test-value",
              "retryable": true
          },
          "warnings": [
              {
                  "type": "voices_not_permitted",
                  "speaker_ids": [
                      "test-value"
                  ],
                  "message": "test-value"
              }
          ],
          "created_at": "2023-01-01T12:34:56Z",
          "updated_at": "2023-01-01T12:34:56Z"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->dubbing->project->language->get(projectId: 'project_id', languageId: 'language_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/project/[^/]+/language/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(204, '');
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->dubbing->project->language->delete(projectId: 'project_id', languageId: 'language_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/project/[^/]+/language/[^/]+$#',
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

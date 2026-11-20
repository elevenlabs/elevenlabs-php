<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Studio\Projects\Chapters;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ChaptersWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "chapters": [
              {
                  "chapter_id": "test-value",
                  "name": "test-value",
                  "last_conversion_date_unix": 1,
                  "conversion_progress": 1,
                  "can_be_downloaded": true,
                  "state": "default",
                  "has_video": true,
                  "has_visual_content": true,
                  "voice_ids": [
                      "test-value"
                  ],
                  "statistics": {
                      "characters_unconverted": 1,
                      "characters_converted": 1,
                      "paragraphs_converted": 1,
                      "paragraphs_unconverted": 1,
                      "credits_needed_to_convert": 1,
                      "voice_statistics": [
                          {
                              "project_voice_ref_id": "test-value",
                              "characters_unconverted": 1,
                              "characters_converted": 1,
                              "credits_needed_to_convert": 1,
                              "voice_id": "test-value"
                          }
                      ]
                  },
                  "last_conversion_error": "test-value"
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->studio->projects->chapters->list(projectId: '21m00Tcm4TlvDq8ikWAM');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/studio/projects/[^/]+/chapters$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "chapter": {
              "chapter_id": "test-value",
              "name": "test-value",
              "last_conversion_date_unix": 1,
              "conversion_progress": 1,
              "can_be_downloaded": true,
              "state": "default",
              "has_video": true,
              "has_visual_content": true,
              "voice_ids": [
                  "test-value"
              ],
              "statistics": {
                  "characters_unconverted": 1,
                  "characters_converted": 1,
                  "paragraphs_converted": 1,
                  "paragraphs_unconverted": 1,
                  "credits_needed_to_convert": 1,
                  "voice_statistics": [
                      {
                          "project_voice_ref_id": "test-value",
                          "characters_unconverted": 1,
                          "characters_converted": 1,
                          "credits_needed_to_convert": 1,
                          "voice_id": "test-value"
                      }
                  ]
              },
              "last_conversion_error": "test-value",
              "content": {
                  "blocks": [
                      {
                          "block_id": "test-value",
                          "nodes": [
                              {
                                  "type": "tts_node",
                                  "project_voice_ref_id": "test-value",
                                  "text": "test-value",
                                  "voice_id": "test-value"
                              }
                          ]
                      }
                  ]
              }
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Studio\Projects\Chapters\Requests\BodyCreateChapterV1StudioProjectsProjectIdChaptersPost(
      [
        'name' => 'Chapter 1',
        'fromUrl' => 'from_url'
      ]
    );
    $sdk->studio->projects->chapters->create(request: $request, projectId: '21m00Tcm4TlvDq8ikWAM');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/studio/projects/[^/]+/chapters$#',
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
          "chapter_id": "test-value",
          "name": "test-value",
          "last_conversion_date_unix": 1,
          "conversion_progress": 1,
          "can_be_downloaded": true,
          "state": "default",
          "has_video": true,
          "has_visual_content": true,
          "voice_ids": [
              "test-value"
          ],
          "statistics": {
              "characters_unconverted": 1,
              "characters_converted": 1,
              "paragraphs_converted": 1,
              "paragraphs_unconverted": 1,
              "credits_needed_to_convert": 1,
              "voice_statistics": [
                  {
                      "project_voice_ref_id": "test-value",
                      "characters_unconverted": 1,
                      "characters_converted": 1,
                      "credits_needed_to_convert": 1,
                      "voice_id": "test-value"
                  }
              ]
          },
          "last_conversion_error": "test-value",
          "content": {
              "blocks": [
                  {
                      "block_id": "test-value",
                      "nodes": [
                          {
                              "type": "tts_node",
                              "project_voice_ref_id": "test-value",
                              "text": "test-value",
                              "voice_id": "test-value"
                          }
                      ]
                  }
              ]
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->studio->projects->chapters->get(
      projectId: '21m00Tcm4TlvDq8ikWAM',
      chapterId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/studio/projects/[^/]+/chapters/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "chapter": {
              "chapter_id": "test-value",
              "name": "test-value",
              "last_conversion_date_unix": 1,
              "conversion_progress": 1,
              "can_be_downloaded": true,
              "state": "default",
              "has_video": true,
              "has_visual_content": true,
              "voice_ids": [
                  "test-value"
              ],
              "statistics": {
                  "characters_unconverted": 1,
                  "characters_converted": 1,
                  "paragraphs_converted": 1,
                  "paragraphs_unconverted": 1,
                  "credits_needed_to_convert": 1,
                  "voice_statistics": [
                      {
                          "project_voice_ref_id": "test-value",
                          "characters_unconverted": 1,
                          "characters_converted": 1,
                          "credits_needed_to_convert": 1,
                          "voice_id": "test-value"
                      }
                  ]
              },
              "last_conversion_error": "test-value",
              "content": {
                  "blocks": [
                      {
                          "block_id": "test-value",
                          "nodes": [
                              {
                                  "type": "tts_node",
                                  "project_voice_ref_id": "test-value",
                                  "text": "test-value",
                                  "voice_id": "test-value"
                              }
                          ]
                      }
                  ]
              }
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $chapterContentBlockInputModelSubType =
      \ElevenLabs\Types\ChapterContentBlockInputModelSubType::P->value;

    $chapterContentParagraphTtsNodeInputModelType =
      \ElevenLabs\Types\ChapterContentParagraphTtsNodeInputModelType::TtsNode->value;

    $chapterContentParagraphTtsNodeInputModel = new \ElevenLabs\Types\ChapterContentParagraphTtsNodeInputModel(
      [
        'type' => $chapterContentParagraphTtsNodeInputModelType,
        'text' => 'text',
        'voiceId' => 'voice_id'
      ]
    );

    $chapterContentBlockInputModel = new \ElevenLabs\Types\ChapterContentBlockInputModel([
      'subType' => $chapterContentBlockInputModelSubType,
      'nodes' => [],
      'blockId' => 'block_id'
    ]);

    $chapterContentInputModel = new \ElevenLabs\Types\ChapterContentInputModel([
      'blocks' => []
    ]);

    $request = new \ElevenLabs\Studio\Projects\Chapters\Requests\BodyUpdateChapterV1StudioProjectsProjectIdChaptersChapterIdPost(
      [
        'name' => 'name',
        'content' => $chapterContentInputModel
      ]
    );
    $sdk->studio->projects->chapters->update(
      request: $request,
      projectId: '21m00Tcm4TlvDq8ikWAM',
      chapterId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/studio/projects/[^/]+/chapters/[^/]+$#',
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
          "status": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->studio->projects->chapters->delete(
      projectId: '21m00Tcm4TlvDq8ikWAM',
      chapterId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/studio/projects/[^/]+/chapters/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testConvertSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "status": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->studio->projects->chapters->convert(
      projectId: '21m00Tcm4TlvDq8ikWAM',
      chapterId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/studio/projects/[^/]+/chapters/[^/]+/convert$#',
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

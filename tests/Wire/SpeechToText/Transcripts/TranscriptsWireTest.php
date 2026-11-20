<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\SpeechToText\Transcripts;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class TranscriptsWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "language_code": "test-value",
          "language_probability": 1,
          "text": "test-value",
          "words": [
              {
                  "text": "test-value",
                  "start": 1,
                  "end": 1,
                  "type": "word",
                  "speaker_id": "test-value",
                  "logprob": 1,
                  "characters": [
                      {
                          "text": "test-value",
                          "start": 1,
                          "end": 1
                      }
                  ],
                  "channel_index": 1
              }
          ],
          "channel_index": 1,
          "additional_formats": [
              {
                  "requested_format": "test-value",
                  "file_extension": "test-value",
                  "content_type": "test-value",
                  "is_base64_encoded": true,
                  "content": "test-value"
              }
          ],
          "transcription_id": "test-value",
          "entities": [
              {
                  "text": "test-value",
                  "entity_type": "test-value",
                  "start_char": 1,
                  "end_char": 1
              }
          ],
          "audio_duration_secs": 1,
          "edited_transcript": {
              "kind": "transcript",
              "text": "test-value",
              "edited_text": "test-value"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->speechToText->transcripts->get(transcriptionId: 'transcription_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/speech-to-text/transcripts/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->speechToText->transcripts->delete(transcriptionId: 'transcription_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/speech-to-text/transcripts/[^/]+$#',
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

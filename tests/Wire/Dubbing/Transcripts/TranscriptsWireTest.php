<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Dubbing\Transcripts;

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
          "transcript_format": "srt",
          "srt": "test-value",
          "webvtt": "test-value",
          "json": {
              "language": "test-value",
              "utterances": [
                  {
                      "text": "test-value",
                      "speaker_id": "test-value",
                      "start_s": 1,
                      "end_s": 1,
                      "words": [
                          {
                              "text": "test-value",
                              "word_type": "test-value",
                              "start_s": 1,
                              "end_s": 1,
                              "characters": [
                                  {
                                      "text": "test-value",
                                      "start_s": 1,
                                      "end_s": 1
                                  }
                              ]
                          }
                      ]
                  }
              ]
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $formatType = \ElevenLabs\Dubbing\Transcripts\Types\GetTranscriptsRequestFormatType::Srt;
    $sdk->dubbing->transcripts->get(
      dubbingId: 'dubbing_id',
      languageCode: 'source',
      formatType: $formatType->value
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/dubbing/[^/]+/transcripts/[^/]+/format/[^/]+$#',
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

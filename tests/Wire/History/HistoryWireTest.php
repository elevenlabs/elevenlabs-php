<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\History;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class HistoryWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "history": [
              {
                  "history_item_id": "test-value",
                  "request_id": "test-value",
                  "voice_id": "test-value",
                  "model_id": "test-value",
                  "voice_name": "test-value",
                  "voice_category": "premade",
                  "text": "test-value",
                  "date_unix": 1,
                  "character_count_change_from": 1,
                  "character_count_change_to": 1,
                  "content_type": "test-value",
                  "state": "test-value",
                  "settings": {
                      "key": "test-value"
                  },
                  "share_link_id": "test-value",
                  "source": "TTS",
                  "alignments": {
                      "alignment": {
                          "characters": [
                              "test-value"
                          ],
                          "character_start_times_seconds": [
                              1
                          ],
                          "character_end_times_seconds": [
                              1
                          ]
                      },
                      "normalized_alignment": {
                          "characters": [
                              "test-value"
                          ],
                          "character_start_times_seconds": [
                              1
                          ],
                          "character_end_times_seconds": [
                              1
                          ]
                      }
                  },
                  "dialogue": [
                      {
                          "text": "test-value",
                          "voice_id": "test-value",
                          "voice_name": "test-value"
                      }
                  ],
                  "output_format": "test-value"
              }
          ],
          "last_history_item_id": "test-value",
          "has_more": true,
          "scanned_until": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sortDirection = \ElevenLabs\History\Types\ListHistoryRequestSortDirection::Asc;
    $source = \ElevenLabs\History\Types\ListHistoryRequestSource::Tts;
    $sdk->history->list(
      request: new \ElevenLabs\History\Requests\ListHistoryRequest([
        'pageSize' => 100,
        'startAfterHistoryItemId' => 'start_after_history_item_id',
        'voiceId' => 'voice_id',
        'modelId' => 'model_id',
        'dateBeforeUnix' => 8,
        'dateAfterUnix' => 2,
        'sortDirection' => $sortDirection->value,
        'search' => 'search',
        'source' => $source->value,
        'sources' => []
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/history$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "history_item_id": "test-value",
          "request_id": "test-value",
          "voice_id": "test-value",
          "model_id": "test-value",
          "voice_name": "test-value",
          "voice_category": "premade",
          "text": "test-value",
          "date_unix": 1,
          "character_count_change_from": 1,
          "character_count_change_to": 1,
          "content_type": "test-value",
          "state": "test-value",
          "settings": {
              "key": "test-value"
          },
          "share_link_id": "test-value",
          "source": "TTS",
          "alignments": {
              "alignment": {
                  "characters": [
                      "test-value"
                  ],
                  "character_start_times_seconds": [
                      1
                  ],
                  "character_end_times_seconds": [
                      1
                  ]
              },
              "normalized_alignment": {
                  "characters": [
                      "test-value"
                  ],
                  "character_start_times_seconds": [
                      1
                  ],
                  "character_end_times_seconds": [
                      1
                  ]
              }
          },
          "dialogue": [
              {
                  "text": "test-value",
                  "voice_id": "test-value",
                  "voice_name": "test-value"
              }
          ],
          "output_format": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->history->get(historyItemId: 'VW7YKqPnjY4h39yTbx2L');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/history/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
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
    $sdk->history->delete(historyItemId: 'VW7YKqPnjY4h39yTbx2L');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/history/[^/]+$#',
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

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Conversations\Topics;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class TopicsWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "topics": [
              {
                  "topic_id": "test-value",
                  "label": "test-value",
                  "description": "test-value",
                  "conversation_count": 1,
                  "parent_topic_id": "test-value",
                  "x_2d": 1,
                  "y_2d": 1,
                  "metrics": {
                      "conversation_count": 1,
                      "sentiment": {
                          "sentiment": {
                              "count": 1,
                              "sum": 1,
                              "min": 1,
                              "max": 1
                          },
                          "frustration": {
                              "count": 1,
                              "sum": 1,
                              "min": 1,
                              "max": 1
                          },
                          "positive_count": 1,
                          "neutral_count": 1,
                          "negative_count": 1
                      },
                      "evaluation_criteria": [
                          {
                              "criteria_id": "test-value",
                              "success_count": 1,
                              "failure_count": 1,
                              "unknown_count": 1
                          }
                      ]
                  },
                  "success_rate": 1
              }
          ],
          "window_start_unix_secs": 1,
          "window_end_unix_secs": 1,
          "aggregated_run_count": 1,
          "has_more": true,
          "next_cursor": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sortBy = \ElevenLabs\Types\TopicSortBy::Conversations;
    $sortDirection = \ElevenLabs\Types\SortDirection::Asc;
    $sdk->agents->conversations->topics->get(
      request: new \ElevenLabs\Agents\Conversations\Topics\Requests\GetTopicsRequest([
        'pageSize' => 51,
        'sortBy' => $sortBy->value,
        'sortDirection' => $sortDirection->value,
        'fromUnixSecs' => 1,
        'toUnixSecs' => 10,
        'includeEvaluationCriteria' => true,
        'cursor' => 'cursor'
      ]),
      agentId: 'agent_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/topics$#',
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

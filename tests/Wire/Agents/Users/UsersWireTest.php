<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Users;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class UsersWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "users": [
              {
                  "user_id": "test-value",
                  "last_contact_unix_secs": 1,
                  "first_contact_unix_secs": 1,
                  "conversation_count": 1,
                  "last_contact_agent_id": "test-value",
                  "last_contact_conversation_id": "test-value",
                  "last_contact_agent_name": "test-value",
                  "sentiment": {
                      "scored_conversation_count": 1,
                      "positive_count": 1,
                      "neutral_count": 1,
                      "negative_count": 1,
                      "average_sentiment_score": 1,
                      "average_frustration_score": 1,
                      "recent_scored_conversation_count": 1,
                      "recent_positive_count": 1,
                      "recent_neutral_count": 1,
                      "recent_negative_count": 1,
                      "recent_average_sentiment_score": 1,
                      "recent_average_frustration_score": 1
                  },
                  "most_frustrated_conversations": [
                      {
                          "conversation_id": "test-value",
                          "agent_id": "test-value",
                          "start_time_unix_secs": 1,
                          "overall_label": "positive",
                          "overall_sentiment_score": 1,
                          "overall_frustration_score": 1
                      }
                  ]
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sortBy = \ElevenLabs\Types\UsersSortBy::LastContactUnixSecs;
    $sortDirection = \ElevenLabs\Types\SortDirection::Asc;
    $sdk->agents->users->list(
      request: new \ElevenLabs\Agents\Users\Requests\ListUsersRequest([
        'agentId' => 'agent_id',
        'branchId' => 'branch_id',
        'callStartBeforeUnix' => 8,
        'callStartAfterUnix' => 2,
        'search' => 'search',
        'pageSize' => 30,
        'sortBy' => $sortBy->value,
        'sortDirection' => $sortDirection->value,
        'cursor' => 'cursor'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/users$#',
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

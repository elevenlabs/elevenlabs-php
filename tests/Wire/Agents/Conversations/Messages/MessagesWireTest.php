<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Conversations\Messages;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class MessagesWireTest extends TestCase
{
  public function testTextSearchSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "meta": {
              "total": 1,
              "page": 1,
              "page_size": 1
          },
          "results": [
              {
                  "conversation_id": "test-value",
                  "agent_id": "test-value",
                  "agent_name": "test-value",
                  "transcript_index": 1,
                  "chunk_text": "test-value",
                  "chunk_highlights": [
                      {
                          "value": "test-value",
                          "is_hit": true
                      }
                  ],
                  "score": 1,
                  "conversation_start_time_unix_secs": 1
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $callSuccessful = \ElevenLabs\Types\EvaluationResultFilter::Success;
    $summaryMode =
      \ElevenLabs\Agents\Conversations\Messages\Types\TextSearchMessagesRequestSummaryMode::Exclude;
    $conversationInitiationSource = \ElevenLabs\Types\ConversationInitiationSource::Unknown;
    $conversationProductType = \ElevenLabs\Types\ConversationProduct::Agents;
    $sortBy = \ElevenLabs\Types\MessageSearchSortBy::SearchScore;
    $sdk->agents->conversations->messages->textSearch(
      request: new \ElevenLabs\Agents\Conversations\Messages\Requests\TextSearchMessagesRequest([
        'textQuery' => 'text_query',
        'agentId' => 'agent_id',
        'visitedAgentIds' => [],
        'visitedAgentBranchIds' => [],
        'triggeredProcedureIds' => [],
        'callSuccessful' => $callSuccessful->value,
        'callStartBeforeUnix' => 10,
        'callStartAfterUnix' => 9,
        'callDurationMinSecs' => 6,
        'callDurationMaxSecs' => 0,
        'ratingMax' => 4,
        'ratingMin' => 3,
        'hasFeedbackComment' => true,
        'userId' => 'user_id',
        'evaluationParams' => [],
        'dataCollectionParams' => [],
        'dynamicVariableParams' => [],
        'toolNames' => [],
        'toolNamesSuccessful' => [],
        'toolNamesErrored' => [],
        'toolIds' => [],
        'toolIdsSuccessful' => [],
        'toolIdsErrored' => [],
        'includeInvalidToolCalls' => true,
        'mainLanguages' => [],
        'phoneNumberIds' => [],
        'whatsappPhoneNumberIds' => [],
        'excludeStatuses' => [],
        'terminationReasons' => [],
        'pageSize' => 20,
        'summaryMode' => $summaryMode->value,
        'conversationInitiationSource' => $conversationInitiationSource->value,
        'textOnly' => true,
        'conversationProductType' => $conversationProductType->value,
        'branchId' => 'branch_id',
        'versionId' => 'version_id',
        'topicIds' => [],
        'sortBy' => $sortBy->value,
        'cursor' => 'cursor'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/conversations/messages/text-search$#',
      rawurldecode($sent->getUri()->getPath())
    );
    parse_str($sent->getUri()->getQuery(), $query);
    $this->assertArrayHasKey('text_query', $query);
  }

  public function testSearchSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "meta": {
              "total": 1,
              "page": 1,
              "page_size": 1
          },
          "results": [
              {
                  "conversation_id": "test-value",
                  "agent_id": "test-value",
                  "agent_name": "test-value",
                  "transcript_index": 1,
                  "chunk_text": "test-value",
                  "chunk_highlights": [
                      {
                          "value": "test-value",
                          "is_hit": true
                      }
                  ],
                  "score": 1,
                  "conversation_start_time_unix_secs": 1
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->conversations->messages->search(
      request: new \ElevenLabs\Agents\Conversations\Messages\Requests\SearchMessagesRequest([
        'textQuery' => 'text_query',
        'agentId' => 'agent_id',
        'branchId' => 'branch_id',
        'pageSize' => 20,
        'cursor' => 'cursor'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/conversations/messages/smart-search$#',
      rawurldecode($sent->getUri()->getPath())
    );
    parse_str($sent->getUri()->getQuery(), $query);
    $this->assertArrayHasKey('text_query', $query);
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

<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\AnalysisItems;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class AnalysisItemsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "analysis_items": [
              {
                  "id": "test-value",
                  "definition": {
                      "name": "test-value",
                      "source": "user",
                      "llm": "gpt-4o-mini",
                      "kind": "evaluation",
                      "conversation_goal_prompt": "test-value",
                      "use_knowledge_base": true,
                      "scoring": {
                          "mode": "binary"
                      }
                  },
                  "access_info": {
                      "is_creator": true,
                      "creator_name": "test-value",
                      "creator_email": "test-value",
                      "role": "admin",
                      "anonymous_access_level_override": "admin",
                      "access_source": "creator"
                  },
                  "created_at_unix_secs": 1,
                  "updated_at_unix_secs": 1,
                  "current_version_id": "test-value",
                  "legacy_source_id": "test-value"
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $kind = \ElevenLabs\Types\AnalysisItemKind::Evaluation;
    $sortDirection = \ElevenLabs\Types\SortDirection::Asc;
    $sdk->agents->analysisItems->list(
      request: new \ElevenLabs\Agents\AnalysisItems\Requests\ListAnalysisItemsRequest([
        'search' => 'search',
        'pageSize' => 89,
        'kind' => $kind->value,
        'analysisItemIds' => ['analysis_item_ids'],
        'createdByUserId' => 'created_by_user_id',
        'sortDirection' => $sortDirection->value,
        'cursor' => 'cursor'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/analysis-items$#',
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
          "definition": {
              "name": "test-value",
              "source": "user",
              "llm": "gpt-4o-mini",
              "kind": "evaluation",
              "conversation_goal_prompt": "test-value",
              "use_knowledge_base": true,
              "scoring": {
                  "mode": "binary"
              }
          },
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          },
          "created_at_unix_secs": 1,
          "updated_at_unix_secs": 1,
          "current_version_id": "test-value",
          "legacy_source_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $userEvaluationAnalysisItemSource =
      \ElevenLabs\Types\UserEvaluationAnalysisItemSource::User->value;

    $llm = \ElevenLabs\Types\Llm::Gpt4OMini->value;

    $userEvaluationAnalysisItemKind =
      \ElevenLabs\Types\UserEvaluationAnalysisItemKind::Evaluation->value;

    $binaryScoringMode = \ElevenLabs\Types\BinaryScoringMode::Binary->value;

    $binaryScoring = new \ElevenLabs\Types\BinaryScoring([
      'mode' => $binaryScoringMode
    ]);
    $userEvaluationAnalysisItemScoring = \ElevenLabs\Types\UserEvaluationAnalysisItemScoring::binary(
      $binaryScoring
    );

    $request = new \ElevenLabs\Types\UserEvaluationAnalysisItem([
      'name' => 'name',
      'source' => $userEvaluationAnalysisItemSource,
      'llm' => $llm,
      'kind' => $userEvaluationAnalysisItemKind,
      'conversationGoalPrompt' => 'conversation_goal_prompt',
      'useKnowledgeBase' => false,
      'scoring' => $userEvaluationAnalysisItemScoring
    ]);
    $sdk->agents->analysisItems->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/analysis-items$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testUpdateAttachmentsSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "results": [
              {
                  "status": "success",
                  "data": {
                      "agent_id": "test-value",
                      "branch_id": "test-value",
                      "action": "attach",
                      "changed": true
                  }
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $analysisItemSource = \ElevenLabs\Types\AnalysisItemSource::User->value;

    $analysisItemAttachmentDestination = new \ElevenLabs\Types\AnalysisItemAttachmentDestination([
      'agentId' => 'agent_id',
      'branchId' => 'branch_id'
    ]);

    $request = new \ElevenLabs\Agents\AnalysisItems\Requests\UpdateAnalysisItemAttachmentsRequestModel(
      [
        'source' => $analysisItemSource,
        'attach' => [],
        'detach' => []
      ]
    );
    $sdk->agents->analysisItems->updateAttachments(
      request: $request,
      analysisItemId: 'analysis_item_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/analysis-items/[^/]+/attachments$#',
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
          "definition": {
              "name": "test-value",
              "source": "user",
              "llm": "gpt-4o-mini",
              "kind": "evaluation",
              "conversation_goal_prompt": "test-value",
              "use_knowledge_base": true,
              "scoring": {
                  "mode": "binary"
              }
          },
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          },
          "created_at_unix_secs": 1,
          "updated_at_unix_secs": 1,
          "current_version_id": "test-value",
          "legacy_source_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->analysisItems->get(analysisItemId: 'analysis_item_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/analysis-items/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "definition": {
              "name": "test-value",
              "source": "user",
              "llm": "gpt-4o-mini",
              "kind": "evaluation",
              "conversation_goal_prompt": "test-value",
              "use_knowledge_base": true,
              "scoring": {
                  "mode": "binary"
              }
          },
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          },
          "created_at_unix_secs": 1,
          "updated_at_unix_secs": 1,
          "current_version_id": "test-value",
          "legacy_source_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $userEvaluationAnalysisItemSource =
      \ElevenLabs\Types\UserEvaluationAnalysisItemSource::User->value;

    $llm = \ElevenLabs\Types\Llm::Gpt4OMini->value;

    $userEvaluationAnalysisItemKind =
      \ElevenLabs\Types\UserEvaluationAnalysisItemKind::Evaluation->value;

    $binaryScoringMode = \ElevenLabs\Types\BinaryScoringMode::Binary->value;

    $binaryScoring = new \ElevenLabs\Types\BinaryScoring([
      'mode' => $binaryScoringMode
    ]);
    $userEvaluationAnalysisItemScoring = \ElevenLabs\Types\UserEvaluationAnalysisItemScoring::binary(
      $binaryScoring
    );

    $request = new \ElevenLabs\Types\UserEvaluationAnalysisItem([
      'name' => 'name',
      'source' => $userEvaluationAnalysisItemSource,
      'llm' => $llm,
      'kind' => $userEvaluationAnalysisItemKind,
      'conversationGoalPrompt' => 'conversation_goal_prompt',
      'useKnowledgeBase' => false,
      'scoring' => $userEvaluationAnalysisItemScoring
    ]);
    $sdk->agents->analysisItems->update(request: $request, analysisItemId: 'analysis_item_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/analysis-items/[^/]+$#',
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
      "test-value"
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->analysisItems->delete(
      request: new \ElevenLabs\Agents\AnalysisItems\Requests\DeleteAnalysisItemsRequest([
        'force' => false
      ]),
      analysisItemId: 'analysis_item_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/analysis-items/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testListVersionsSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "versions": [
              {
                  "id": "test-value",
                  "version_number": 1,
                  "created_at_unix_secs": 1,
                  "definition": {
                      "name": "test-value",
                      "source": "user",
                      "llm": "gpt-4o-mini",
                      "kind": "evaluation",
                      "conversation_goal_prompt": "test-value",
                      "use_knowledge_base": true,
                      "scoring": {
                          "mode": "binary"
                      }
                  }
              }
          ],
          "current_version_id": "test-value",
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->analysisItems->listVersions(
      request: new \ElevenLabs\Agents\AnalysisItems\Requests\ListVersionsAnalysisItemsRequest([
        'pageSize' => 30,
        'cursor' => 'cursor'
      ]),
      analysisItemId: 'analysis_item_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/analysis-items/[^/]+/versions$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCopySendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "definition": {
              "name": "test-value",
              "source": "user",
              "llm": "gpt-4o-mini",
              "kind": "evaluation",
              "conversation_goal_prompt": "test-value",
              "use_knowledge_base": true,
              "scoring": {
                  "mode": "binary"
              }
          },
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          },
          "created_at_unix_secs": 1,
          "updated_at_unix_secs": 1,
          "current_version_id": "test-value",
          "legacy_source_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->analysisItems->copy(analysisItemId: 'analysis_item_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/analysis-items/[^/]+/copy$#',
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

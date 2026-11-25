<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\TriageTickets;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class TriageTicketsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agent_conversation_tickets": [
              {
                  "agentqa_ticket_id": "test-value",
                  "workspace_id": "test-value",
                  "owner_user_id": "test-value",
                  "agent_id": "test-value",
                  "needs_clustering": true,
                  "title": "test-value",
                  "issue_type": "test-value",
                  "labels": [
                      "test-value"
                  ],
                  "conversation_ids": [
                      "test-value"
                  ],
                  "first_seen_unix_secs": 1,
                  "last_seen_unix_secs": 1,
                  "qa_comment": "test-value",
                  "ticket_comments": [
                      {
                          "comment": "test-value",
                          "created_at_unix_secs": 1,
                          "owner_user_id": "test-value"
                      }
                  ],
                  "turn_comments": [
                      {
                          "turn_index": 1,
                          "comment": "test-value",
                          "created_at_unix_secs": 1,
                          "owner_user_id": "test-value"
                      }
                  ],
                  "status": "open",
                  "priority": "low",
                  "priority_changes": [
                      {
                          "priority": "low",
                          "changed_by_user_id": "test-value",
                          "changed_at_unix_secs": 1
                      }
                  ],
                  "status_changes": [
                      {
                          "status": "open",
                          "changed_by_user_id": "test-value",
                          "changed_at_unix_secs": 1
                      }
                  ],
                  "merged_into_ticket_id": "test-value",
                  "source": "qa",
                  "assignee_user_id": "test-value",
                  "created_at_unix_secs": 1,
                  "updated_at_unix_secs": 1,
                  "search_match": {
                      "field": "title",
                      "snippet": "test-value",
                      "highlight_start": 1,
                      "highlight_end": 1,
                      "turn_index": 1
                  }
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $status = \ElevenLabs\Types\AgentConversationTicketStatus::Open;
    $sortBy = \ElevenLabs\Types\AgentConversationTicketSortBy::CreatedAt;
    $sdk->agents->triageTickets->list(
      request: new \ElevenLabs\Agents\TriageTickets\Requests\ListTriageTicketsRequest([
        'pageSize' => 100,
        'conversationId' => 'conversation_id',
        'status' => $status->value,
        'sources' => [],
        'priorities' => [],
        'sortBy' => $sortBy->value,
        'ownerUserId' => 'owner_user_id',
        'assigneeUserId' => 'assignee_user_id',
        'label' => 'label',
        'mergedIntoTicketId' => 'merged_into_ticket_id',
        'search' => 'search',
        'cursor' => 'cursor'
      ]),
      agentId: 'agent_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/triage-tickets$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateManualSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agentqa_ticket_id": "test-value",
          "workspace_id": "test-value",
          "owner_user_id": "test-value",
          "agent_id": "test-value",
          "needs_clustering": true,
          "title": "test-value",
          "issue_type": "test-value",
          "labels": [
              "test-value"
          ],
          "conversation_ids": [
              "test-value"
          ],
          "first_seen_unix_secs": 1,
          "last_seen_unix_secs": 1,
          "qa_comment": "test-value",
          "ticket_comments": [
              {
                  "comment": "test-value",
                  "created_at_unix_secs": 1,
                  "owner_user_id": "test-value"
              }
          ],
          "turn_comments": [
              {
                  "turn_index": 1,
                  "comment": "test-value",
                  "created_at_unix_secs": 1,
                  "owner_user_id": "test-value"
              }
          ],
          "status": "open",
          "priority": "low",
          "priority_changes": [
              {
                  "priority": "low",
                  "changed_by_user_id": "test-value",
                  "changed_at_unix_secs": 1
              }
          ],
          "status_changes": [
              {
                  "status": "open",
                  "changed_by_user_id": "test-value",
                  "changed_at_unix_secs": 1
              }
          ],
          "merged_into_ticket_id": "test-value",
          "source": "qa",
          "assignee_user_id": "test-value",
          "created_at_unix_secs": 1,
          "updated_at_unix_secs": 1,
          "search_match": {
              "field": "title",
              "snippet": "test-value",
              "highlight_start": 1,
              "highlight_end": 1,
              "turn_index": 1
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $agentConversationTicketPriority =
      \ElevenLabs\Types\AgentConversationTicketPriority::Low->value;

    $request = new \ElevenLabs\Agents\TriageTickets\Requests\CreateManualTicketRequestModel([
      'title' => 'title',
      'qaComment' => 'qa_comment',
      'priority' => $agentConversationTicketPriority
    ]);
    $sdk->agents->triageTickets->createManual(request: $request, agentId: 'agent_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/triage-tickets$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testListForWorkspaceSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agent_conversation_tickets": [
              {
                  "agentqa_ticket_id": "test-value",
                  "workspace_id": "test-value",
                  "owner_user_id": "test-value",
                  "agent_id": "test-value",
                  "needs_clustering": true,
                  "title": "test-value",
                  "issue_type": "test-value",
                  "labels": [
                      "test-value"
                  ],
                  "conversation_ids": [
                      "test-value"
                  ],
                  "first_seen_unix_secs": 1,
                  "last_seen_unix_secs": 1,
                  "qa_comment": "test-value",
                  "ticket_comments": [
                      {
                          "comment": "test-value",
                          "created_at_unix_secs": 1,
                          "owner_user_id": "test-value"
                      }
                  ],
                  "turn_comments": [
                      {
                          "turn_index": 1,
                          "comment": "test-value",
                          "created_at_unix_secs": 1,
                          "owner_user_id": "test-value"
                      }
                  ],
                  "status": "open",
                  "priority": "low",
                  "priority_changes": [
                      {
                          "priority": "low",
                          "changed_by_user_id": "test-value",
                          "changed_at_unix_secs": 1
                      }
                  ],
                  "status_changes": [
                      {
                          "status": "open",
                          "changed_by_user_id": "test-value",
                          "changed_at_unix_secs": 1
                      }
                  ],
                  "merged_into_ticket_id": "test-value",
                  "source": "qa",
                  "assignee_user_id": "test-value",
                  "created_at_unix_secs": 1,
                  "updated_at_unix_secs": 1,
                  "search_match": {
                      "field": "title",
                      "snippet": "test-value",
                      "highlight_start": 1,
                      "highlight_end": 1,
                      "turn_index": 1
                  }
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $status = \ElevenLabs\Types\AgentConversationTicketStatus::Open;
    $sortBy = \ElevenLabs\Types\AgentConversationTicketSortBy::CreatedAt;
    $sdk->agents->triageTickets->listForWorkspace(
      request: new \ElevenLabs\Agents\TriageTickets\Requests\ListForWorkspaceTriageTicketsRequest([
        'pageSize' => 100,
        'agentId' => 'agent_id',
        'status' => $status->value,
        'sources' => [],
        'priorities' => [],
        'sortBy' => $sortBy->value,
        'ownerUserId' => 'owner_user_id',
        'assigneeUserId' => 'assignee_user_id',
        'label' => 'label',
        'mergedIntoTicketId' => 'merged_into_ticket_id',
        'search' => 'search',
        'cursor' => 'cursor'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/triage-tickets$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agentqa_ticket_id": "test-value",
          "workspace_id": "test-value",
          "owner_user_id": "test-value",
          "agent_id": "test-value",
          "needs_clustering": true,
          "title": "test-value",
          "issue_type": "test-value",
          "labels": [
              "test-value"
          ],
          "conversation_ids": [
              "test-value"
          ],
          "first_seen_unix_secs": 1,
          "last_seen_unix_secs": 1,
          "qa_comment": "test-value",
          "ticket_comments": [
              {
                  "comment": "test-value",
                  "created_at_unix_secs": 1,
                  "owner_user_id": "test-value"
              }
          ],
          "turn_comments": [
              {
                  "turn_index": 1,
                  "comment": "test-value",
                  "created_at_unix_secs": 1,
                  "owner_user_id": "test-value"
              }
          ],
          "status": "open",
          "priority": "low",
          "priority_changes": [
              {
                  "priority": "low",
                  "changed_by_user_id": "test-value",
                  "changed_at_unix_secs": 1
              }
          ],
          "status_changes": [
              {
                  "status": "open",
                  "changed_by_user_id": "test-value",
                  "changed_at_unix_secs": 1
              }
          ],
          "merged_into_ticket_id": "test-value",
          "source": "qa",
          "assignee_user_id": "test-value",
          "created_at_unix_secs": 1,
          "updated_at_unix_secs": 1,
          "search_match": {
              "field": "title",
              "snippet": "test-value",
              "highlight_start": 1,
              "highlight_end": 1,
              "turn_index": 1
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $turnCommentRequestModel = new \ElevenLabs\Types\TurnCommentRequestModel([
      'turnIndex' => 10,
      'comment' => 'comment'
    ]);

    $agentConversationTicketPriority =
      \ElevenLabs\Types\AgentConversationTicketPriority::Low->value;

    $request = new \ElevenLabs\Agents\TriageTickets\Requests\CreateAgentConversationTicketRequestModel(
      [
        'conversationId' => 'conversation_id',
        'title' => 'title',
        'qaComment' => 'qa_comment',
        'turnComments' => [],
        'priority' => $agentConversationTicketPriority
      ]
    );
    $sdk->agents->triageTickets->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/triage-tickets$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testListAssignableUsersSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      [
          {
              "user_id": "test-value",
              "email": "test-value",
              "first_name": "test-value",
              "is_service_account": true,
              "has_access": true
          }
      ]
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->triageTickets->listAssignableUsers(agentId: 'agent_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/triage-tickets/assignable-users$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agentqa_ticket_id": "test-value",
          "workspace_id": "test-value",
          "owner_user_id": "test-value",
          "agent_id": "test-value",
          "needs_clustering": true,
          "title": "test-value",
          "issue_type": "test-value",
          "labels": [
              "test-value"
          ],
          "conversation_ids": [
              "test-value"
          ],
          "first_seen_unix_secs": 1,
          "last_seen_unix_secs": 1,
          "qa_comment": "test-value",
          "ticket_comments": [
              {
                  "comment": "test-value",
                  "created_at_unix_secs": 1,
                  "owner_user_id": "test-value"
              }
          ],
          "turn_comments": [
              {
                  "turn_index": 1,
                  "comment": "test-value",
                  "created_at_unix_secs": 1,
                  "owner_user_id": "test-value"
              }
          ],
          "status": "open",
          "priority": "low",
          "priority_changes": [
              {
                  "priority": "low",
                  "changed_by_user_id": "test-value",
                  "changed_at_unix_secs": 1
              }
          ],
          "status_changes": [
              {
                  "status": "open",
                  "changed_by_user_id": "test-value",
                  "changed_at_unix_secs": 1
              }
          ],
          "merged_into_ticket_id": "test-value",
          "source": "qa",
          "assignee_user_id": "test-value",
          "created_at_unix_secs": 1,
          "updated_at_unix_secs": 1,
          "search_match": {
              "field": "title",
              "snippet": "test-value",
              "highlight_start": 1,
              "highlight_end": 1,
              "turn_index": 1
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->triageTickets->get(agentqaTicketId: 'agentqa_ticket_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/triage-tickets/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agentqa_ticket_id": "test-value",
          "workspace_id": "test-value",
          "owner_user_id": "test-value",
          "agent_id": "test-value",
          "needs_clustering": true,
          "title": "test-value",
          "issue_type": "test-value",
          "labels": [
              "test-value"
          ],
          "conversation_ids": [
              "test-value"
          ],
          "first_seen_unix_secs": 1,
          "last_seen_unix_secs": 1,
          "qa_comment": "test-value",
          "ticket_comments": [
              {
                  "comment": "test-value",
                  "created_at_unix_secs": 1,
                  "owner_user_id": "test-value"
              }
          ],
          "turn_comments": [
              {
                  "turn_index": 1,
                  "comment": "test-value",
                  "created_at_unix_secs": 1,
                  "owner_user_id": "test-value"
              }
          ],
          "status": "open",
          "priority": "low",
          "priority_changes": [
              {
                  "priority": "low",
                  "changed_by_user_id": "test-value",
                  "changed_at_unix_secs": 1
              }
          ],
          "status_changes": [
              {
                  "status": "open",
                  "changed_by_user_id": "test-value",
                  "changed_at_unix_secs": 1
              }
          ],
          "merged_into_ticket_id": "test-value",
          "source": "qa",
          "assignee_user_id": "test-value",
          "created_at_unix_secs": 1,
          "updated_at_unix_secs": 1,
          "search_match": {
              "field": "title",
              "snippet": "test-value",
              "highlight_start": 1,
              "highlight_end": 1,
              "turn_index": 1
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $agentConversationTicketStatus = \ElevenLabs\Types\AgentConversationTicketStatus::Open->value;

    $agentConversationTicketPriority =
      \ElevenLabs\Types\AgentConversationTicketPriority::Low->value;

    $request = new \ElevenLabs\Agents\TriageTickets\Requests\PatchAgentConversationTicketRequestModel(
      [
        'title' => 'title',
        'qaComment' => 'qa_comment',
        'status' => $agentConversationTicketStatus,
        'assigneeUserId' => 'assignee_user_id',
        'priority' => $agentConversationTicketPriority
      ]
    );
    $sdk->agents->triageTickets->update(request: $request, agentqaTicketId: 'agentqa_ticket_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/triage-tickets/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(204, '');
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->triageTickets->delete(agentqaTicketId: 'agentqa_ticket_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/triage-tickets/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testAddCommentSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agentqa_ticket_id": "test-value",
          "workspace_id": "test-value",
          "owner_user_id": "test-value",
          "agent_id": "test-value",
          "needs_clustering": true,
          "title": "test-value",
          "issue_type": "test-value",
          "labels": [
              "test-value"
          ],
          "conversation_ids": [
              "test-value"
          ],
          "first_seen_unix_secs": 1,
          "last_seen_unix_secs": 1,
          "qa_comment": "test-value",
          "ticket_comments": [
              {
                  "comment": "test-value",
                  "created_at_unix_secs": 1,
                  "owner_user_id": "test-value"
              }
          ],
          "turn_comments": [
              {
                  "turn_index": 1,
                  "comment": "test-value",
                  "created_at_unix_secs": 1,
                  "owner_user_id": "test-value"
              }
          ],
          "status": "open",
          "priority": "low",
          "priority_changes": [
              {
                  "priority": "low",
                  "changed_by_user_id": "test-value",
                  "changed_at_unix_secs": 1
              }
          ],
          "status_changes": [
              {
                  "status": "open",
                  "changed_by_user_id": "test-value",
                  "changed_at_unix_secs": 1
              }
          ],
          "merged_into_ticket_id": "test-value",
          "source": "qa",
          "assignee_user_id": "test-value",
          "created_at_unix_secs": 1,
          "updated_at_unix_secs": 1,
          "search_match": {
              "field": "title",
              "snippet": "test-value",
              "highlight_start": 1,
              "highlight_end": 1,
              "turn_index": 1
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\TriageTickets\Requests\AddTicketCommentRequestModel([
      'comment' => 'comment'
    ]);
    $sdk->agents->triageTickets->addComment(
      request: $request,
      agentqaTicketId: 'agentqa_ticket_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/triage-tickets/[^/]+/comments$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testMergeSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agentqa_ticket_id": "test-value",
          "workspace_id": "test-value",
          "owner_user_id": "test-value",
          "agent_id": "test-value",
          "needs_clustering": true,
          "title": "test-value",
          "issue_type": "test-value",
          "labels": [
              "test-value"
          ],
          "conversation_ids": [
              "test-value"
          ],
          "first_seen_unix_secs": 1,
          "last_seen_unix_secs": 1,
          "qa_comment": "test-value",
          "ticket_comments": [
              {
                  "comment": "test-value",
                  "created_at_unix_secs": 1,
                  "owner_user_id": "test-value"
              }
          ],
          "turn_comments": [
              {
                  "turn_index": 1,
                  "comment": "test-value",
                  "created_at_unix_secs": 1,
                  "owner_user_id": "test-value"
              }
          ],
          "status": "open",
          "priority": "low",
          "priority_changes": [
              {
                  "priority": "low",
                  "changed_by_user_id": "test-value",
                  "changed_at_unix_secs": 1
              }
          ],
          "status_changes": [
              {
                  "status": "open",
                  "changed_by_user_id": "test-value",
                  "changed_at_unix_secs": 1
              }
          ],
          "merged_into_ticket_id": "test-value",
          "source": "qa",
          "assignee_user_id": "test-value",
          "created_at_unix_secs": 1,
          "updated_at_unix_secs": 1,
          "search_match": {
              "field": "title",
              "snippet": "test-value",
              "highlight_start": 1,
              "highlight_end": 1,
              "turn_index": 1
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\TriageTickets\Requests\MergeAgentConversationTicketsRequestModel(
      [
        'sourceTicketIds' => ['source_ticket_ids']
      ]
    );
    $sdk->agents->triageTickets->merge(request: $request, agentqaTicketId: 'agentqa_ticket_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/triage-tickets/[^/]+/merge$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testAddTurnCommentSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agentqa_ticket_id": "test-value",
          "workspace_id": "test-value",
          "owner_user_id": "test-value",
          "agent_id": "test-value",
          "needs_clustering": true,
          "title": "test-value",
          "issue_type": "test-value",
          "labels": [
              "test-value"
          ],
          "conversation_ids": [
              "test-value"
          ],
          "first_seen_unix_secs": 1,
          "last_seen_unix_secs": 1,
          "qa_comment": "test-value",
          "ticket_comments": [
              {
                  "comment": "test-value",
                  "created_at_unix_secs": 1,
                  "owner_user_id": "test-value"
              }
          ],
          "turn_comments": [
              {
                  "turn_index": 1,
                  "comment": "test-value",
                  "created_at_unix_secs": 1,
                  "owner_user_id": "test-value"
              }
          ],
          "status": "open",
          "priority": "low",
          "priority_changes": [
              {
                  "priority": "low",
                  "changed_by_user_id": "test-value",
                  "changed_at_unix_secs": 1
              }
          ],
          "status_changes": [
              {
                  "status": "open",
                  "changed_by_user_id": "test-value",
                  "changed_at_unix_secs": 1
              }
          ],
          "merged_into_ticket_id": "test-value",
          "source": "qa",
          "assignee_user_id": "test-value",
          "created_at_unix_secs": 1,
          "updated_at_unix_secs": 1,
          "search_match": {
              "field": "title",
              "snippet": "test-value",
              "highlight_start": 1,
              "highlight_end": 1,
              "turn_index": 1
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\TriageTickets\Requests\AddTurnCommentRequestModel([
      'turnIndex' => 9,
      'comment' => 'comment'
    ]);
    $sdk->agents->triageTickets->addTurnComment(
      request: $request,
      agentqaTicketId: 'agentqa_ticket_id'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/triage-tickets/[^/]+/turn-comments$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
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

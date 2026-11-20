<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetAgentConversationTicketsPageResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
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
    JSON;

    $instance = \ElevenLabs\Types\GetAgentConversationTicketsPageResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
